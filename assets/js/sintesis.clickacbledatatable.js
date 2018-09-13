
// <!-- //Ini script bagus tapi belum ketemu solusinya hha
// <script type="text/javascript">
// var table = $('.dataTable').DataTable();
// $('.dataTable').on('click', 'tbody tr', function() {
//   // console.log('TD cell textContent : ', this.textContent);
//   // alert(table.row(this).data());
//   var data = table.row(this).data().map(function(item, index) {
//      var r = {}; 
//      r['col'+index]=item; 
//      return r;
//   })
// })
//     $('#tabelobat').on('click', 'tbody tr', function() {
//         var data = table.row(this).data().map(function(item, index) {
//             var r = {}; 
//             r['col'+index]=item; 
//             //return console.log(r);
//             return r;
//         })
//     //now use AJAX with data, which is on the form [ { col1 : value, col2: value ..}]
//         $.ajax({
//             data: data,
//             url: "<?php echo base_URL('obat/sintesis/look')?>",
//             success: function(response) {
//                 //console.log(response);
//             }
//         });
//     });
// </script> -->