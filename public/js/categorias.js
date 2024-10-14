
let btnsCreateNote;
let btnsUpdateNote;
let btnsDeleteNote;
let formCreateNote;

function init() {
    console.log("init");

    btnsCreateNote = document.querySelectorAll('.btnCreateNote');
    formCreateNote = document.querySelector('#form-note');

    btnsUpdateNote = document.querySelectorAll('.btnUpdateNote');
    btnsDeleteNote = document.querySelectorAll('.btnDeleteNote');
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
            formCreateNote.action = 'http://127.0.0.1:8000/note/update/' + idNote
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
                    document.querySelector('.form-delete-'+idNote).submit();
                }
            });

            // let modal = new bootstrap.Modal(document.querySelector('#modal-notes'));
            // modal.show();
        });
    })
}

function updateCategory() {
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

    })

}

function deleteCategory() {
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
    })
}

function setCategoryIdToDelete(categoryId) {
    categoryId2 = categoryId;
    // Actualizar la acción del formulario con el id de la categoría
    var form = updateModal.querySelector('form');
    form.action = `/category/delete/${categoryId2}`;
}

function setCategoryIdToUpdate(categoryIdBlade) {
    categoryId = categoryIdBlade;
    // Actualizar la acción del formulario con el id de la categoría
    var form = updateModal.querySelector('form');
    form.action = `/category/update/${categoryId}`;
}

document.addEventListener('DOMContentLoaded', function () {
    init();
    createNote();
    updateNote();
    deleteNote();
    //     deleteCategory();
});
