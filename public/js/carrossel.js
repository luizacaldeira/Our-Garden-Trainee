
    const swiper = new Swiper('.swiper', {

    direction: 'vertical',
    loop: true,
    slidesPerView: 3,
    spaceBetween: 20,


    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },

    watchOverflow: true,
    mousewheel: true,
    effect: "coverflow",         
    grabCursor: true,            
    centeredSlides: true,             
    loop: true,                  
    coverflowEffect: { 
        rotate: 0,                
        stretch: 0,                
        depth: 0,                
        modifier: 1,               
        slideShadows: false,        
    }, 
}); 

