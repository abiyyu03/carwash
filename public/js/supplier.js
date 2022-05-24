// $(document).ready(function(){
//     $('.data-supplier').DataTable();
//     $('.deleteButton').on("click",function(event){
//         event.preventDefault();
//         var url = $(this).attr('href');
//         console.log(url);
//         swal.fire({
//             title: 'Apakah Kamu yakin ingin menghapus data ini ?',
//             text: "Data yang terhapus tidak bisa di kembalikan!",
//             icon: 'warning',
//             // buttons: ["Cancel","Yakin!"],
//             showCancelButton: true,
//             // confirmButtonColor: '#3085d6',
//             // cancelButtonColor: '#d33',
//             confirmButtonText: 'Yakin !'
//         }).then((result) => {
//             if (result.isConfirmed) {
//                 window.location.href = url;
//             }
//         });
//     });
    
//     var table = $('.data-supplier').DataTable();
//     // $('#editButton').on("click",function(){
//     table.on("click",'#editButton',function(){
//         $tr = $(this).closest('tr');
//         if($($tr).hasClass('child')){
//             $tr = $tr.prev('.parent');
//         }
        
//         var data = table.row($tr).data();
//         // console.log(data);
        
//         $('#edit_supplier_name').val(data[1]);
//         $('#edit_supplier_address').val(data[2]);
//         $('#edit_supplier_contact').val(data[3]);
//         $('#editForm').attr('action','supplier/update/'+data[0]);
//         $('#editModal').modal('show');
        
//     });
// });