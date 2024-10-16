
let btnsCreateNote;
let btnsUpdateNote;
let btnsDeleteNote;
let formCreateNote;
let formCreateCategory;
let btnsCreateCategory;
let btnsUpdateCategory;
let btnsDeleteCategory;

function init() {
    console.log("init");
    formCreateNote = document.querySelector('#form-note');
    formCreateCategory = document.querySelector('#form-category');

    btnsCreateNote = document.querySelectorAll('.btnCreateNote');
    btnsUpdateNote = document.querySelectorAll('.btnUpdateNote');
    btnsDeleteNote = document.querySelectorAll('.btnDeleteNote');
    btnsCreateCategory = document.querySelectorAll('.btnCreateCategory');
    btnsUpdateCategory = document.querySelectorAll('.btnUpdateCategory');
    btnsDeleteCategory = document.querySelectorAll('.btnDeleteCategory');
}

function createNote() {
    btnsCreateNote.forEach(btnCreateNote => {
        btnCreateNote.addEventListener('click', function () {
            let idCategory = this.dataset.idCategory;
            formCreateNote.action = 'http://127.0.0.1:8000/note/create/' + idCategory

            let modal = new bootstrap.Modal(document.querySelector('#modal-notes'));
            modal.show();
        });
    })


    /*
     btnAccept.addEventListener('click', function () {

         NameCategory = document.getElementById('categoryName').value;
        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        console.log("Nombre: " + NameCategory);

        if (NameCategory == '') {
             console.log("VACIO");
            window.alert("El nombre de la categoría no puede estar vacío")
        } else {
            fetch('/category/create', {
               method: 'POST',
               headers: {
                     'Content-Type': 'application/json',
                     'X-CSRF-TOKEN': token
                 },
                 body: JSON.stringify({
                     name: NameCategory,
                 }),
             })
                 .then(response => response.json())
                 .then(data => {
                     console.log(data);
                     // Verifica si la categoría se creó exitosamente
                     if (data.status === 'success') {
                         // Limpia el campo de entrada
                         document.getElementById('categoryName').value = ""; // Pone en blanco el campo
                         // Cierra el modal
                         const modal = bootstrap.Modal.getInstance(document.getElementById('exampleModal')); // Busca nuestro modal para pdoer cerrarlo
                         modal.hide(); // Cierra el modal
                     }
                 })
                 .catch(error => console.error('Error', error));
         }
     });*/
}

function updateNote() {
    btnsUpdateNote.forEach(btnUpdateNote => {
        btnUpdateNote.addEventListener('click', function () {
            let idNote = this.dataset.idNote;
            formCreateNote.action = 'http://127.0.0.1:8000/note/update/' + idNote;
            document.querySelector('#newName').value = this.dataset.title;
            document.querySelector('#newDesc').value = this.dataset.desc;

            let modal = new bootstrap.Modal(document.querySelector('#modal-notes'));
            modal.show();
        });
    })
}

function deleteNote() {
    btnsDeleteNote.forEach(btnDeleteNote => {
        btnDeleteNote.addEventListener('click', function () {
            let idNote = this.dataset.idNote;
            console.log("Nota eliminada: " + idNote);
            Swal.fire({
                title: 'Advertencia!',
                text: 'Estas seguro de eliminar esta nota',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Aquí puedes ejecutar la lógica de eliminación
                    console.log("Nota eliminada: " + idNote);
                    document.querySelector('.form-delete-' + idNote).submit();
                }
            });
        });
    });
}

function createCategory() {
    btnsCreateCategory.forEach(btnCreateCategory => {
        btnCreateCategory.addEventListener('click', function () {
            formCreateCategory.action = 'http://127.0.0.1:8000/category/create';

            let modal = new bootstrap.Modal(document.querySelector('#modal-category'));
            modal.show();
        });
    });
}

function updateCategory() {
    btnsUpdateCategory.forEach(btnUpdateCategory => {
        btnUpdateCategory.addEventListener('click', function () {
            let idCategory = this.dataset.idCategory;
            formCreateCategory.action = 'http://127.0.0.1:8000/category/update/' + idCategory;
            document.querySelector('#categoryName').value = this.dataset.name;

            let modal = new bootstrap.Modal(document.querySelector('#modal-category'));
            modal.show();
        });
    });

    /*
    UpdateCategory.addEventListener('click', function () {
        NewName = document.getElementById('newName').value;
        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        console.log("Nuevo: " + NewName + " ID: " + categoryId);

        fetch('/category/update', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify({
                id: categoryId,
                name: NewName
            }),

        }).then(response => response.json())
            .then(data => {
                console.log(data);
                if (data.status === 'success') {
                    // Limpia el campo de entrada
                    document.getElementById('newName').value = ""; // Pone en blanco el campo
                    // Cierra el modal

                    const modal = bootstrap.Modal.getInstance(document.getElementById('updateModal')); // Busca nuestro modal para pdoer cerrarlo
                    modal.hide(); // Cierra el modal
                }
            })
            .catch(error => console.error('Error', error))

    })*/

}

function deleteCategory() {
    btnsDeleteCategory.forEach(btnDeleteCategory => {
        btnDeleteCategory.addEventListener('click', function () {
            let idCategory = this.dataset.idCategory;
            console.log("Id Categoria eliminada: " + idCategory);
             Swal.fire({
                title: 'Advertencia!',
                html: 'Estas seguro de eliminar esta categoria' + '</br>' + 'Al eliminar la categoria se eliminaras las notas que esten dentro',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar'
             }).then((result) => {
                if (result.isConfirmed) {
                    // Aquí puedes ejecutar la lógica de eliminación
                    console.log("Categoria eliminada: " + idCategory);
                    document.querySelector('.form-delete-'+ idCategory).submit();
                 }
            });
        });
    });
    /*
    btnDelete.addEventListener('click', function () {
        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        console.log("ID: " + categoryId2);

        fetch('/category/delete', {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify({
                id: categoryId2,
            }),

        }).then(response => response.json())
            .then(data => {
                console.log(data);
                if (data.status === 'success') {
                    const modal = bootstrap.Modal.getInstance(document.getElementById('deleteModal')); // Busca nuestro modal para pdoer cerrarlo
                    modal.hide(); // Cierra el modal
                } else if (data.status === 'excepcion') {
                    window.alert(data.message);
                }
            })
            .catch(error => console.error('Error', error));
    })*/
}


document.addEventListener('DOMContentLoaded', function () {
    init();
    createNote();
    updateNote();
    deleteNote();
    createCategory();
    updateCategory();
    deleteCategory();
});
