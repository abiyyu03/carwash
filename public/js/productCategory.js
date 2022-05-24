// $(document).ready(function(){
//     var table = $('.data-productCategory').DataTable();
//     // $('#editButton').on("click",function(){
//     table.on("click",'#editButton',function(){
//         $tr = $(this).closest('tr');
//         if($($tr).hasClass('child')){
//             $tr = $tr.prev('.parent');
//         }
        
//         var data = table.row($tr).data();
//         console.log(data);
        
//         $('#edit_category_name').val(data[1]);
//         $('#edit_product_type_id ').val(data[0]);
//         $('#editForm').attr('action','product_category/update/'+data[0]);
//         $('#editModal').modal('show');
//     });
// });