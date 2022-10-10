// grid.on('rowRemoving', function (e, $row, id, record) {
//     // if (confirm('Are you sure?')) {
//     //     $.ajax({ url: '/Players/Delete', data: { id: id }, method: 'POST' })
//     //         .done(function () {
//     //             grid.reload();
//     //         })
//     //         .fail(function () {
//     //             alert('Failed to delete.');
//     //         });
//     // }
//     var data = $.extend(true, {}, record);
//     console.log(id);
// });
// grid.on('rowDataChanged', function (e, id, record) {
//     var data = $.extend(true, {}, record);
//     console.log(data);
//     // data.DateOfBirth = gj.core.parseDate(record.DateOfBirth, 'mm/dd/yyyy').toISOString();
//     // Post the data to the server
//     // $.ajax({ url: '/Players/Save', data: { record: data }, method: 'POST' })
//     //     .fail(function () {
//     //         alert('Failed to save.');
//     //     });
// });
