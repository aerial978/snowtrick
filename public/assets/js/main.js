$('.gallery-item').on('click',function(){
    let pictureLink = $(this).attr('data-link');
    console.log(pictureLink);
    $('.modal-img').attr('src',pictureLink);
});