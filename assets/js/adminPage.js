const content = document.getElementById('content')
const searchBox = document.getElementById('searchBox')
const categoryBox = document.getElementById('categoryBox')
const categoryBoxAdd = document.getElementById('categoryBoxAdd')

const addBeritaForm = document.getElementById('addBeritaForm')

const editBeritaForm = document.getElementById('editBeritaForm')

let kategoriBeritaList
// let jumlahItem

// NOTE fungsi GetNews & Filter & Search
async function getNews(title = '', category = '', page = 0) {
    let getNewsFetch
    if (title != '' && category == '') {
        getNewsFetch = await fetch('../include_file/api.php', {
            method: 'POST',
            body: JSON.stringify({
                'method': 'getNewsAdm',
                'title': title,
                'page': page
            }),
            headers: {
                "Content-Type": "application/json"
            }
        })
    } else if (title == '' && category != '') {
        getNewsFetch = await fetch('../include_file/api.php', {
            method: 'POST',
            body: JSON.stringify({
                'method': 'getNewsAdm',
                'category': category,
                'page': page
            }),
            headers: {
                "Content-Type": "application/json"
            }
        })
    } else if (title != '' && category != '') {
        getNewsFetch = await fetch('../include_file/api.php', {
            method: 'POST',
            body: JSON.stringify({
                'method': 'getNewsAdm',
                'title': title,
                'category': category,
                'page': page
            }),
            headers: {
                "Content-Type": "application/json"
            }
        })
    } else {
        getNewsFetch = await fetch('../include_file/api.php', {
            method: 'POST',
            body: JSON.stringify({
                'method': 'getNewsAdm',
                'page': page
            }),
            headers: {
                "Content-Type": "application/json"
            }
        })
    }

    getNewsFetch.json().then(data => {
        console.log(data)
        if (data['response'] == '404') {
            content.innerHTML = "<tr><td colspan=6>Berita tidak ada</td></tr>"
        } else {
            let i = (10 * page) + 1;
            content.innerHTML = ""
            data['data'].map(items => {
                let status_berita
                if (items['status_berita'] == 1) {
                    status_berita = "Tayang"
                } else {
                    status_berita = "Tidak Tayang"
                }
                const wrapper = document.createElement('tr')
                wrapper.innerHTML = [
                    `<td style="width: 5%">${i}</td>`,
                    `<td style="width: 30%">${items['judul_berita']}</td>`,
                    `<td style="width: 10%">${items['nama_kategori']}</td>`,
                    `<td style="width: 25%">${items['tanggalpenulisan_berita']}</td>`,
                    `<td style="width: 15%">${status_berita}</td>`,
                    `<td style="width: 15%"><button onclick="deleteBerita(${items['id_berita']})" class="btn btn-danger me-2">Hapus</button><button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalEditBerita" onclick="getEditBerita(${items['id_berita']})">Edit</button></td>`,
                ].join('')
                content.append(wrapper)
                i++
            })
        }


    })
}

// NOTE get jumlah items
// async function getItemsCount() {
//     await fetch('../include_file/api.php', {
//         method: 'POST',
//         body: JSON.stringify({
//             'method': 'getItemsCount',
//         }),
//         headers: {
//             "Content-Type": "application/json"
//         }
//     }).then(response => {
//         jumlahItem = response.json()
//     })
// }

// NOTE get Kategori Berita
async function getKategoriBerita() {
    await fetch('../include_file/api.php', {
        method: 'POST',
        body: JSON.stringify({
            'method': 'getCategoryList',
        }),
        headers: {
            "Content-Type": "application/json"
        }
    }).then(response => {
        kategoriBeritaList = response.json()
    })
}

// NOTE add Berita
function addBerita(data) {
    data = data
    fetch('../include_file/api_upload_file.php', {
        method: 'POST',
        body: data,
    }).then(response => {
        response.json().then(data => {
            if (data['response'] == '1') {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Berita berhasil disimpan',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    setTimeout(() => {
                        window.location.reload()
                    }, 0)
                })
            } else {
                console.log(data)
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: data['message'],
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        })
    })
}

// NOTE hapus berita
function deleteBerita(id) {
    Swal.fire({
        title: 'Apakah Yakin?',
        text: "Aksi tidak bisa dibatalkan",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya'
    }).then(async (result) => {
        if (result.isConfirmed) {
            await fetch('../include_file/api.php', {
                method: 'POST',
                body: JSON.stringify({
                    'method': 'deleteNews',
                    'id': id
                }),
                headers: {
                    "Content-Type": "application/json"
                }
            }).then(response => {
                response.json().then(data => {
                    if (data['response'] == '1') {
                        Swal.fire(
                            'Dihapus!',
                            'Berita sudah dihapus',
                            'success'
                        )
                        setTimeout(() => {
                            window.location.reload()
                        }, 1000)
                    } else {
                        Swal.fire(
                            'Error!',
                            'Berita gagal dihapus',
                            'error'
                        )
                    }
                })
            })

        }
    })
}

// NOTE get untuk edit Berita
function getEditBerita(id) {    
    let editGambarBerita = document.getElementById('editgambarBerita')
    let editJudulBerita = document.getElementById('editJudulBerita')
    let editIsiBerita = document.getElementById('editisiBerita')
    let editKategoriBerita = document.getElementById('editkategoriBerita')
    let editIdBerita = document.getElementById('idBeritaEdit')
    fetch('../include_file/api.php', {
        method: 'POST',
        body: JSON.stringify({
            'method': 'getNewsById',
            'id': id
        }),
        headers: {
            "Content-Type": "application/json"
        }
    }).then(response => {
        response.json().then(data => {
            editGambarBerita.value = ''
            console.log(data['data'][0]['id_berita'])
            editIdBerita.value = data['data'][0]['id_berita']
            editJudulBerita.value = data['data'][0]['judul_berita']
            editIsiBerita.value = data['data'][0]['isi_berita']
            kategoriBeritaList.then(res => {
                editKategoriBerita.innerHTML = ''
                res['data'].map(items => {
                    if (items['id_kategori'] == data['data'][0]['kategori_berita']) {
                        editKategoriBerita.innerHTML += `<option value="${items['id_kategori']}" selected>${items['nama_kategori']}</option>`
                    } else {
                        editKategoriBerita.innerHTML += `<option value="${items['id_kategori']}">${items['nama_kategori']}</option>`
                    }

                })
            })
        })
    })
}


// NOTE edit Berita Submit
function editBerita(data) {
    data = data
    fetch('../include_file/api_upload_file.php', {
        method: 'POST',
        body: data,
    }).then(response => {
        response.json().then(data => {
            console.log(data)
            if (data['response'] == '1') {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Berita berhasil diedit',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    setTimeout(() => {
                        window.location.reload()
                    }, 0)
                })
            } else {
                console.log(data)
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: data['message'],
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        })
    })
}


document.addEventListener("DOMContentLoaded", async function (e) {
    getNews()
    // let jumahBerita

    await getKategoriBerita()
    // await getItemsCount()

    // jumlahItem.then(data => {
    //     jumahBerita = data['data']
    // })

    kategoriBeritaList.then(data => {
        data['data'].map(items => {
            categoryBox.innerHTML += `<option value="${items['id_kategori']}">${items['nama_kategori']}</option>`
            categoryBoxAdd.innerHTML += `<option value="${items['id_kategori']}">${items['nama_kategori']}</option>`
        })
    })

    searchBox.addEventListener('keyup', () => {
        let title = searchBox.value;
        let kategori = categoryBox.value
        getNews(title, kategori)
    })

    categoryBox.addEventListener('change', () => {
        let title = searchBox.value;
        let kategori = categoryBox.value
        getNews(title, kategori)
    })

    addBeritaForm.addEventListener('submit', function (e) {
        e.preventDefault()
        let data = new FormData(e.target)
        data.append('addBerita', '')
        addBerita(data)

    })

    editBeritaForm.addEventListener('submit', function (e){
        e.preventDefault()
        let data = new FormData(e.target)
        data.append('editBerita', '')
        editBerita(data)
    })

});