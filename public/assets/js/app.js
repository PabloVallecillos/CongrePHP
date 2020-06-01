$(document).ready(function(){
   
    //  document.getElementsByClassName('fa-play')[5].addEventListener('click', function(){
    //      location.href = 'http://informatica.ieszaidinvergeles.org:9040/CongrePHP/public/asistant';
    //  }); 
    // ALERT
    $(function() {
        $(".alert2").delay(8000).fadeOut('slow');
    });
   // NAV
    $('.menu__btn').click(function(e){
        e.preventDefault();
      $('.menu').toggleClass('show-menu');
    })
    //PROFILE CARD
    $('.menu-container').hover(
        function(){
            $('.profile-actions').slideDown('fast');
          $('.list-icon').addClass('active');
        },
        function(){
            $('.profile-actions').slideUp('fast');
          $('.list-icon').removeClass('active');
        }
    );
    $('.profile-card').mouseleave(function(){
        $('.profile-actions').slideUp('fast');
        $('.profile-info').slideUp('fast');
        $('.profile-map').slideUp('fast');
    });

    $('.profile-avatar').hover(
        function(){
            $('.profile-links').fadeIn('fast');
        },
        function(){
            $('.profile-links').hide();
        }
    );
    $('.read-more').click(function(){
        $('.profile-map').slideUp('fast');
        $('.profile-info').slideToggle('fast');
        return false;
    });
    $('.view-map').click(function(){
        $('.profile-info').slideUp('fast');
        $('.profile-map').slideToggle('fast');
        return false;
    });
    
    if ($('.labelico').length) {
      // si existe
        document.querySelectorAll('.labelico')[1].style.paddingLeft = 0;
    } else {
      // no existe
    }
    
    // Drag 
    // Guardamos en variales los elementos que vamos a usar
    const fileInput = document.getElementById('form-input_file'),
    dropZone = document.getElementById('drop-zone'),
    form = document.getElementById('form');
    
    document.getElementById('blah').style.display = "none";
    // CONDICIÓN PARA COMPROBAR LA EXISTENCIA DE VARIABLES
    
    // Esto sustituye al funcionamiento del botón tradicional
    dropZone.addEventListener('click', () => fileInput.click());
    
    // Este evento nos controla cuando hemos selecionado algo
    fileInput.addEventListener('change', (e) => {
    // Con esto podemos ver los elementos que hemos seleccionado
        console.log(fileInput.files);
        readURL(this);
        document.getElementById('blah').style.display = "flex";
        document.getElementsByClassName('flxi1')[0].style.transform = "scale(0.6) !important";
    });
    
    function readURL(input) {
      if (fileInput.files && fileInput.files[0]) {
        
        var reader = new FileReader();
        
        reader.onload = function(e) {
          $('#blah').attr('src', e.target.result);
        }
        
        reader.readAsDataURL(fileInput.files[0]); // convert to base64 string
        document.getElementById('blah').style.display = "flex";
        // transform: scale(0.6);
        document.getElementsByClassName('flxi1')[0].style.transform = "scale(0.6)";
      }
    }
    
    // Animamos el paso por encima de la zona
    dropZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropZone.classList.add('drop-zone_active')
    });
    
    // Desaninamos la salida del paso por encima de la zona
    dropZone.addEventListener('dragleave', (e) => {
        e.preventDefault();
        dropZone.classList.remove('drop-zone_active')
    });
    
    // Aquí recogemos los elementos seleccionados
    // También le pasamos los elementos seleccionados al botón tradicional
    // para que el funcionamiento sea el mismo
    dropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropZone.classList.remove('drop-zone_active')
        // Con esta instrucción le pasamos los valores
        fileInput.files = e.dataTransfer.files;
    
        // Con esto podemos ver los elementos que hemos seleccionado
        console.log(fileInput.files);
        console.log(fileInput.files[0]);
        readURL(this);
    });
    
    // No dejamos subir los archivos si no hay archivo
    form.addEventListener('submit', (e) => {
        if (fileInput.files.length == 0) {
            e.preventDefault();
        }
    });
    
    
});