let btnPlus;
let NameCategory;
let btnAccept;
let UpdateCategory;
let NewName;
let updateModal;
let btnDelete;
let categoryId;
let categoryId2;

function init() {
    console.log("init");
    btnPlus = document.getElementById('PlusCategory');
    btnAccept = document.getElementById('btnAccept');
    UpdateCategory = document.getElementById('btnUpdate');
    btnDelete = document.getElementById('btnDelete');
}

// function PlusCategory() {
//     btnAccept.addEventListener('click', function () {

//         NameCategory = document.getElementById('categoryName').value;
//         let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

//         console.log("Nombre: " + NameCategory);

//         if (NameCategory == '') {
//             console.log("VACIO");
//             window.alert("El nombre de la categoría no puede estar vacío")
//         } else {

//             fetch('/category/create', {
//                 method: 'POST',
//                 headers: {
//                     'Content-Type': 'application/json',
//                     'X-CSRF-TOKEN': token
//                 },
//                 body: JSON.stringify({
//                     name: NameCategory,
//                 }),
//             })
//                 .then(response => response.json())
//                 .then(data => {
//                     console.log(data);
//                     // Verifica si la categoría se creó exitosamente
//                     if (data.status === 'success') {
//                         // Limpia el campo de entrada
//                         document.getElementById('categoryName').value = ""; // Pone en blanco el campo
//                         // Cierra el modal

//                         const modal = bootstrap.Modal.getInstance(document.getElementById('exampleModal')); // Busca nuestro modal para pdoer cerrarlo
//                         modal.hide(); // Cierra el modal
//                     }
//                 })
//                 .catch(error => console.error('Error', error));

//         }

//     });
// }

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
    //PlusCategory();
//     updateCategory();
//     deleteCategory();
 });
