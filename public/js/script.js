$(document).ready(function(){
  $(".owl-carousel").owlCarousel();
});

$('.owl-carousel').owlCarousel({

    margin:30,
    autoWidth:true,
    nav:false,


    responsive:{
        0:{
            items:1,
            margin:10,
        },
        600:{
            items:3,

        },
        1000:{
            items:3
        }
    }
})

$('#myModal').on('shown.bs.modal', function () {
  $('#myInput').trigger('focus')
})

$('#myModal2').on('shown.bs.modal', function () {
  $('#myInput').trigger('focus')
})


let isMobile = {
    Android: function() {return navigator.userAgent.match(/Android/i);},
    BlackBerry: function() {return navigator.userAgent.match(/BlackBerry/i);},
    iOS: function() {return navigator.userAgent.match(/iPhone|iPad|iPod/i);},
    Opera: function() {return navigator.userAgent.match(/Opera Mini/i);},
    Windows: function() {return navigator.userAgent.match(/IEMobile/i);},
    any: function() {return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());}
};
        let body=document.querySelector('body');
if(isMobile.any()){
        body.classList.add('touch');
        let arrow=document.querySelectorAll('.arrow');
    for(i=0; i<arrow.length; i++){
            let thisLink=arrow[i].previousElementSibling;
            let subMenu=arrow[i].nextElementSibling;
            let thisArrow=arrow[i];

            thisLink.classList.add('parent');
        arrow[i].addEventListener('click', function(){
            subMenu.classList.toggle('open');
            thisArrow.classList.toggle('active');
        });
    }
}else{
    body.classList.add('mouse');
}
