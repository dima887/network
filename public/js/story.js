$('#brest').on('click', function(){ //При клике по элементу с id=price выполнять...
    $.ajax({
        url: '/main/brest', //Путь к файлу, который нужно подгрузить
        type: 'GET',
        beforeSend: function(){
            $('#story-network').empty(); //Перед выполнением очищает содержимое блока с id=content
        },
        success: function(responce){
            $('#story-network').append(responce); //Подгрузка внутрь блока с id=content
        },
        error: function(){
            alert('Error!');
        }
    });
});
//
// $('#vitebsk.php').on('click', function(){ //При клике по элементу с id=price выполнять...
//     $.ajax({
//         url: '/main/vitebsk.php', //Путь к файлу, который нужно подгрузить
//         type: 'GET',
//         beforeSend: function(){
//             $('#story-network').empty(); //Перед выполнением очищает содержимое блока с id=content
//         },
//         success: function(responce){
//             $('#story-network').append(responce); //Подгрузка внутрь блока с id=content
//         },
//         error: function(){
//             alert('Error!');
//         }
//     });
// });
//
// $('#gomel').on('click', function(){ //При клике по элементу с id=price выполнять...
//     $.ajax({
//         url: '/main/gomel', //Путь к файлу, который нужно подгрузить
//         type: 'GET',
//         beforeSend: function(){
//             $('#story-network').empty(); //Перед выполнением очищает содержимое блока с id=content
//         },
//         success: function(responce){
//             $('#story-network').append(responce); //Подгрузка внутрь блока с id=content
//         },
//         error: function(){
//             alert('Error!');
//         }
//     });
// });
//
// $('#grodno').on('click', function(){ //При клике по элементу с id=price выполнять...
//     $.ajax({
//         url: '/main/grodno', //Путь к файлу, который нужно подгрузить
//         type: 'GET',
//         beforeSend: function(){
//             $('#story-network').empty(); //Перед выполнением очищает содержимое блока с id=content
//         },
//         success: function(responce){
//             $('#story-network').append(responce); //Подгрузка внутрь блока с id=content
//         },
//         error: function(){
//             alert('Error!');
//         }
//     });
// });
//
// $('#minsk').on('click', function(){ //При клике по элементу с id=price выполнять...
//     $.ajax({
//         url: '/main/minsk', //Путь к файлу, который нужно подгрузить
//         type: 'GET',
//         beforeSend: function(){
//             $('#story-network').empty(); //Перед выполнением очищает содержимое блока с id=content
//         },
//         success: function(responce){
//             $('#story-network').append(responce); //Подгрузка внутрь блока с id=content
//         },
//         error: function(){
//             alert('Error!');
//         }
//     });
// });
//
// $('#mogilev').on('click', function(){ //При клике по элементу с id=price выполнять...
//     $.ajax({
//         url: '/main/mogilev', //Путь к файлу, который нужно подгрузить
//         type: 'GET',
//         beforeSend: function(){
//             $('#story-network').empty(); //Перед выполнением очищает содержимое блока с id=content
//         },
//         success: function(responce){
//             $('#story-network').append(responce); //Подгрузка внутрь блока с id=content
//         },
//         error: function(){
//             alert('Error!');
//         }
//     });
// });


// $(document).ready(function() {
//
//     // Check for hash value in URL
//     var hash = window.location.hash.substr(1);
//     var href = $('#nav li a').each(function(){
//         var href = $(this).attr('href');
//         if(hash==href.substr(0,href.length-5)){
//             var toLoad = hash+'.html #story-network';
//             $('#story-network').load(toLoad)
//         }
//     });
//
//     $('#nav li a').click(function(){
//
//         var toLoad = $(this).attr('href')+' #story-network';
//         $('#story-network').hide('fast',loadContent);
//         $('#load').remove();
//         $('#wrapper').append('<span id="load">LOADING...</span>');
//         $('#load').fadeIn('normal');
//         window.location.hash = $(this).attr('href').substr(0,$(this).attr('href').length-5);
//         function loadContent() {
//             $('#story-network').load(toLoad,'',showNewContent())
//         }
//         function showNewContent() {
//             $('#story-network').show('normal',hideLoader());
//         }
//         function hideLoader() {
//             $('#load').fadeOut('normal');
//         }
//         return false;
//
//     });
// });