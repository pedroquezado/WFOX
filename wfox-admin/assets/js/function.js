//CONVERTE SVG
$(function(){
    jQuery('img.svg').each(function(){
        var $img = jQuery(this);
        var imgID = $img.attr('id');
        var imgClass = $img.attr('class');
        var imgURL = $img.attr('src');
    
        jQuery.get(imgURL, function(data) {
            // Get the SVG tag, ignore the rest
            var $svg = jQuery(data).find('svg');
    
            // Add replaced image's ID to the new SVG
            if(typeof imgID !== 'undefined') {
                $svg = $svg.attr('id', imgID);
            }
            // Add replaced image's classes to the new SVG
            if(typeof imgClass !== 'undefined') {
                $svg = $svg.attr('class', imgClass+' replaced-svg');
            }
    
            // Remove any invalid XML tags as per http://validator.w3.org
            $svg = $svg.removeAttr('xmlns:a');
            
            // Check if the viewport is set, else we gonna set it if we can.
            if(!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
                $svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'))
            }
    
            // Replace image with new SVG
            $img.replaceWith($svg);
    
        }, 'xml');
    
    });
});

// MENU NAVBAR
function navMenuDrop() {
    document.getElementById("navMenuDrop").classList.toggle("show");
    if($(".dropbtn").hasClass("dActive")) {
        $('.dropbtn').removeClass('dActive');
    } else {
        $('.dropbtn').addClass('dActive');
    }
}
window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
        $('.dropbtn').removeClass('dActive');
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}

//PEGA VARIAVEIS (URL)
function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}

//NOVO POST - NOVO USER - EDIT USER
$(document).ready(function() {
    $(".but-sav").click(function(){
        var butDate = $(this).attr("but-date");
        if(butDate == 'post'){
            var newLastID = getUrlVars()["newLastID"];
            var validEditor = getUrlVars()["id_post"];
            if(validEditor){
                newLastID = getUrlVars()["id_post"];
            }
            var formData = {
                'wfox_api'        : 'post',
                'wfox_form'       : 'add',
                'p_titulo'        : $('input[name=pTitle]').val(),
                'p_stitulo'       : $('input[name=pStitle]').val(),
                'p_desc'          : document.getElementById("editor").innerHTML,
                'p_visibilidade'  : $('input[name=visib-post]:checked').val(),
                'p_link'          : $('.url-postTemp').text(),
                'p_template'      : $('select[name=page_personalit]').val(),
                'p_thumb'         : $('input[name=thumbTempPost]').val(),
                'newLastID'       : newLastID,
            };
            $.ajax({
                type: 'POST',
                url: url_log + '/define_log.php',
                data: formData,
                cache: false,
                beforeSend: function() {
                    $(".load-reload").html('<img class="load_img-dark" src="' + url_adm + '/assets/images/load/loadG1ae45f.png">');
                },
                success : function(html){
                    if(validEditor){
                        if(html == 1) {
                            window.location = url_adm + "/index.php?action=edit-post&id_post=" + newLastID;
                        } else {
                            window.location = url_adm + "/index.php?action=posts&result=editPost&posiID=" + newLastID + "&result=error";
                        }
                    } else {
                        if(html == 1) {
                            window.location = url_adm + "/index.php?action=posts&result=addPost&posiID=" + newLastID;
                        } else {
                            window.location = url_adm + "/index.php?action=posts&result=addPost&posiID=" + newLastID + "&result=error";
                        }
                    }
                },
                error: function(xhr) {
                    window.location = url_adm + "/index.php?action=posts&posiID=" + newLastID + "&result=error";
                }
            });
        }

        if(butDate == 'user'){
            var editUserID = $('input[name=editUserID]').val();
            var wfox_form = $('input[name=wfox_userForm]').val();
            var u_email     = $('input[name=u_email]').val();
            var u_nome      = $('input[name=u_nome]').val();
            var u_sobrenome = $('input[name=u_sobrenome]').val();
            var u_senha     = $('input[name=u_senha]').val();

            if(wfox_form == 'add'){
                if(u_email != '' && u_nome != '' && u_sobrenome != '' && u_senha != '') {
                    var formData = {
                        'wfox_api'      : 'user',
                        'wfox_form'     : wfox_form,
                        'u_email'       : u_email,
                        'u_nome'        : u_nome,
                        'u_sobrenome'   : u_sobrenome,
                        'u_senha'       : u_senha,
                        'u_role'        : $('select[name=u_role]').val(),
                        'u_thumb'       : $('input[name=thumbTempProfile]').val(),
                    };

                    $.ajax({
                        type: 'POST',
                        url: url_log + '/define_log.php',
                        data: formData,
                        cache: false,
                        beforeSend: function() {
                            $(".load-reload").html('<img class="load_img-dark" src="' + url_adm + '/assets/images/load/loadG1ae45f.png">');
                        },
                        success : function(html){
                            if(html == 1) {
                                window.location = url_adm + "/index.php?action=users&result=add-success";
                            } else {
                                window.location = url_adm + "/index.php?action=users&result=add-error";
                            }
                        },
                        error: function(xhr) {
                            $(".load-reload").html('ERROR::CONNECT');
                        }
                    });
                } else {
                    alert('Preencher todos os campos.');
                }
            }
            
            if(wfox_form == 'edit'){
                if(u_email != '' && u_nome != '' && u_sobrenome != '') {
                    var formData = {
                        'wfox_api'      : 'user',
                        'wfox_form'     : wfox_form,
                        'u_id'          : editUserID,
                        'u_email'       : u_email,
                        'u_nome'        : u_nome,
                        'u_sobrenome'   : u_sobrenome,
                        'u_senha'       : u_senha,
                        'u_role'        : $('select[name=u_role]').val(),
                        'u_thumb'       : $('input[name=thumbTempProfile]').val(),
                    };

                    $.ajax({
                        type: 'POST',
                        url: url_log + '/define_log.php',
                        data: formData,
                        cache: false,
                        beforeSend: function() {
                            $(".load-reload").html('<img class="load_img-dark" src="' + url_adm + '/assets/images/load/loadG1ae45f.png">');
                        },
                        success : function(html){
                            if(html == 1) {
                                window.location = url_adm + "/index.php?action=edit-user&id_user=" + editUserID + "&result=add-success";
                            } else {
                                window.location = url_adm + "/index.php?action=edit-user&id_user=" + editUserID + "&result=add-error";
                            }
                        },
                        error: function(xhr) {
                            $(".load-reload").html('ERROR::CONNECT');
                        }
                    });
                }
            }
        }
    });
});

//DELET POST - DELET USER
$(document).ready(function() {
    $(".butList-delet").click(function(){
        var bText = $(this).text();
        var bID = $(this).attr("id-post-delet");
        var formData = {
            'wfox_api'   : 'post',
            'wfox_form'  : 'delet',
            'id_post'    : bID,
        };
        $.ajax({
            type: 'POST',
            url: url_log + '/define_log.php',
            data: formData,
            cache: false,
            beforeSend: function() {
                $('.lPostID-' + bID + ' .butList-delet').html('<img class="load_img-dark" src="' + url_adm + '/assets/images/load/loadG1ae45f.png">');
            },
            success : function(html){
                if(html == 1) {
                    $('.lPostID-' + bID).fadeOut('fast');
                } else {
                    $('.lPostID-' + bID + ' .butList-delet').html(bText);
                }
            },
            error: function(xhr) {
                $('.lPostID-' + bID + ' .butList-delet').html(bText);
            }
        });
    });

    $(".butUser-delet").click(function(){
        var bText = $(this).text();
        var bID = $(this).attr("id-user-delet");
        var formData = {
            'wfox_api'   : 'user',
            'wfox_form'  : 'delet',
            'id_user'    : bID,
        };
        $.ajax({
            type: 'POST',
            url: url_log + '/define_log.php',
            data: formData,
            cache: false,
            beforeSend: function() {
                $('.lUserID-' + bID + ' .butUser-delet').html('<img class="load_img-dark" src="' + url_adm + '/assets/images/load/loadG1ae45f.png">');
            },
            success : function(html){
                if(html == 1) {
                    $('.lUserID-' + bID).fadeOut('fast');
                } else {
                    $('.lUserID-' + bID + ' .butUser-delet').html(bText);
                }
            },
            error: function(xhr) {
                $('.lUserID-' + bID + ' .butUser-delet').html(bText);
            }
        });
    });
});

//URL POST
$(function(){
    $("input#pTitle").on("keyup", function(e){
        var str = $(this).val();
        var newLastID = getUrlVars()["newLastID"];
        var validEditor = getUrlVars()["id_post"];
        if(validEditor){
            newLastID = getUrlVars()["id_post"];
        }
        var tag = $("span.url-postTemp");
        if(str !== ""){
            var formData = {
                'wfox_api'   : 'post',
                'wfox_form'  : 'url_change',
                'url_post'    : str,
            };
            $.ajax({
                type: 'POST',
                url: url_log + '/define_log.php',
                data: formData,
                cache: false,
                beforeSend: function() {
                    tag.html('<img class="load_img-dark" src="' + url_adm + '/assets/images/load/loadG1ae45f.png">');
                },
                success : function(html){
                    tag.html(html);
                },
                error: function(xhr) {
                    tag.html('ERROR');
                }
            });
        } else {
            tag.html('p' + newLastID);
        }
    });
});

//NOVAS CAT E TAGS
$(function(){
    $("#newCatBut").on("keyup", function(e){
        var tReturn = $(this).val();
        if(tReturn !== ""){
            $(".submitNewCat").fadeIn("fast");
        } else {
            $(".submitNewCat").fadeOut("fast");
        }
    });

    $("#newTagBut").on("keyup", function(e){
        var tReturn = $(this).val();
        if(tReturn !== ""){
            $(".submitNewTag").fadeIn("fast");
        } else {
            $(".submitNewTag").fadeOut("fast");
        }
    });
});

/*
$(document).ready(function() {
    $("div#editor img").resizable({
        autoHide: true,
        containment: "parent",
        aspectRatio: true,
        handles:"ne,nw,se,sw",
        minHeight: 100,
        minWidth: 100,
    });
});
*/

//UPLOAD CAT E TAGS
$(document).ready(function() {
    $(".submitNewCat").click(function(){
        var tReturn = $('input#newCatBut').val();
        var newLastID = getUrlVars()["newLastID"];
        var formData = {
            'wfox_api'    : 'post',
            'wfox_form'   : 'addNewReturn',
            'rType'       : 'cat',
            'newValue'    : tReturn,
        };
        $.ajax({
            type: 'POST',
            url: url_log + '/define_log.php',
            data: formData,
            cache: false,
            beforeSend: function() {
                $('input#newCatBut').val('');
                $(".submitNewCat").fadeOut("fast");
            },
            success : function(html){
                $(".listBtn-cats ul").append(html);
            },
            error: function(xhr) {
                $(".listBtn-cats ul").append('<li>ERROR</li>');
            }
        });
    });

    $(".submitNewTag").click(function(){
        var tReturn = $('input#newTagBut').val();
        var newLastID = getUrlVars()["newLastID"];
        var formData = {
            'wfox_api'    : 'post',
            'wfox_form'   : 'addNewReturn',
            'rType'       : 'tag',
            'newValue'    : tReturn,
        };
        $.ajax({
            type: 'POST',
            url: url_log + '/define_log.php',
            data: formData,
            cache: false,
            beforeSend: function() {
                $('input#newTagBut').val('');
                $(".submitNewTag").fadeOut("fast");
            },
            success : function(html){
                $(".listBtn-tags ul").append(html);
            },
            error: function(xhr) {
                $(".listBtn-tags ul").append('<li>ERROR</li>');
            }
        });
    });
});

//REGISTRAR CAT E TAGS (POST / PAGE)
$(document).ready(function() {
    $(".listBtn-cats label").click(function(){
        var lFor   = $(this).attr("for");
        var lInput = $('input[name=newcategory]#' + lFor).attr("value");
        var newLastID = getUrlVars()["newLastID"];
        var validEditor = getUrlVars()["id_post"];
        if(validEditor){
            newLastID = getUrlVars()["id_post"];
        }
        var formData = {
            'wfox_api'    : 'post',
            'wfox_form'   : 'addFilter',
            'rType'       : 'cat',
            'pc_post_id'  : newLastID,
            'pc_cat_id'   : lInput,
        };
        $.ajax({
            type: 'POST',
            url: url_log + '/define_log.php',
            data: formData,
            cache: false,
            success : function(html){
                if(html == 0) {
                    alert('ERROR::ADD_CAT');
                }
            },
            error: function(xhr) {
                alert('ERROR::ADD_CAT');
            }
        });
    });

    $(".listBtn-tags label").click(function(){
        var lFor   = $(this).attr("for");
        var lInput = $('input[name=newtag]#' + lFor).attr("value");
        var newLastID = getUrlVars()["newLastID"];
        var validEditor = getUrlVars()["id_post"];
        if(validEditor){
            newLastID = getUrlVars()["id_post"];
        }
        var formData = {
            'wfox_api'    : 'post',
            'wfox_form'   : 'addFilter',
            'rType'       : 'tag',
            'pt_post_id'  : newLastID,
            'pt_tag_id'   : lInput,
        };
        $.ajax({
            type: 'POST',
            url: url_log + '/define_log.php',
            data: formData,
            cache: false,
            success : function(html){
                if(html == 0) {
                    alert('ERROR::ADD_TAG');
                }
            },
            error: function(xhr) {
                alert('ERROR::ADD_TAG');
            }
        });
    });
});

// LIMIT DE POSTS NA PAGINA
$(document).ready(function() {
    $('select#pLimitView').on('change', function() {
        var url = window.location = url_adm + '/index.php?action=posts&&pLimitView=' + this.value;  
        window.location = url;
    })
});

$(document).ready(function() {
    $("#view-urlbtn").click(function(){
        $('#permalink').addClass("url-show");
        if($("#view-urlbtn").hasClass("tooltip")) {
            $('#tooltipLink').css('opacity',0);
        } else {
            $('#tooltipLink').removeAttr('style');
        }
    });
});
$(document).click(function(e) {   
    if(e.target.id != 'view-urlbtn' && e.target.id != 'permalink' && e.target.id != 'nssL') {
        $('#permalink').removeClass("url-show");
    } 
});


$(document).ready(function(){
    $(".mToggle", this).click(function(){
        var sThis = $(this).find(".conf-post-subtitle");
        var sFinal = $(this).find(".ref-toggle.statPost-listBtn");
        if(sThis.data('clicked', true)) {
            if(sFinal.hasClass("tShow")) {
                sFinal.removeClass('tShow');
            } else {
                sFinal.addClass('tShow');
            }
        }
    });
});

//VERIFICA SENHA
function verifica(){
    senha = document.getElementById("u_senha").value;
    forca = 0;
    mostra = document.getElementById("returnPass");
    if((senha.length >= 4) && (senha.length <= 7)){
        forca += 10;
    }else if(senha.length>7){
        forca += 25;
    }
    if(senha.match(/[a-z]+/)){
        forca += 10;
    }
    if(senha.match(/[A-Z]+/)){
        forca += 20;
    }
    if(senha.match(/d+/)){
        forca += 20;
    }
    if(senha.match(/W+/)){
        forca += 25;
    }
    return mostra_res();
}
function mostra_res(){
    if(forca < 30){
        mostra.innerHTML = '<div class="verf-PassBox med1"> Fraca </div>';
    }else if((forca >= 30) && (forca < 45)){
        mostra.innerHTML = '<div class="verf-PassBox med2"> Justa </div>';;
    }else if((forca >= 45) && (forca < 60)){
        mostra.innerHTML = '<div class="verf-PassBox med3"> Forte </div>';
    }else{
        mostra.innerHTML = '<div class="verf-PassBox med4"> Excelente </div>';
    }
}


/*
* GALLERY
*/
// UPLOAD IMAGE PROFILE
$(document).ready(function(){
    var returnImageThumbProfile = $('#status');
    $('#imagem').live('change',function(){
        $('#formulario').ajaxForm({
            beforeSend: function() {},
            uploadProgress: function(event, position, total, percentComplete) {},
            complete: function(xhr) {
                returnImageThumbProfile.attr('style','background-image: url(' + xhr.responseText + '); background-size: cover');

                var url = xhr.responseText;
                var match = url.match(/[^\/\\]+.jpg/);
                if (!match) alert('não encontrou...');
                else $('input[name=thumbTempProfile]').attr('value', match[0]);
            }
        }).submit();
    });
});
// UPLOAD IMAGE POST/PAGE
$(document).ready(function(){
    var returnImageThumbProfile = $('#featured');
    $('#imagemPost').live('change',function(){
        $('#formulario').ajaxForm({
            beforeSend: function() {},
            uploadProgress: function(event, position, total, percentComplete) {},
            complete: function(xhr) {
                returnImageThumbProfile.attr('src',xhr.responseText);

                var url = xhr.responseText;
                var match = url.match(/[^\/\\]+.jpg/);
                if (!match) alert('não encontrou...');
                else $('input[name=thumbTempPost]').attr('value', match[0]);
            }
        }).submit();
    });
});



//FUNÇÃO AJAX GALLERY MODAL BOX
function viewReturneThumb(){
    var gallery = $('.gallery-viewBox');
    var formData = {
        'wfox_api'    : 'upload',
        'wfox_form'   : 'gallery',
    };
    $.ajax({
        type: 'POST',
        url: url_log + '/define_log.php',
        data: formData,
        cache: false,
        beforeSend: function() {
            gallery.html('<div class="loadImgMarg"><img class="load_img-dark" src="' + url_adm + '/assets/images/load/loadG1ae45f.png"></div>');
        },
        success : function(html){
            gallery.html(html);
        },
        error: function(xhr) {
            gallery.html('ERROR');
        }
    });
}

// UPLOAD IMAGE GALLERY (POST, PAG)
$(document).ready(function(){
    var progressbar = $('#progress');
    var completed   = '0%';
    $('#upGalerryImagem').live('change',function(){
        $('#formulario').ajaxForm({
            beforeSend: function() {
                progressbar.fadeIn('fast');
                progressbar.width(completed);
            },
            uploadProgress: function(event, position, total, percentComplete) {
                progressbar.width(percentComplete + '%');
            },
            complete: function(xhr) {
                progressbar.fadeOut('1000');

                var gallery = $('.gallery-viewBox');
                var upload  = $('.upload-new-file');
                upload.css('display','none');
                gallery.css('display','block');
                viewReturneThumb();

                var url = xhr.responseText;
                var match = url.match(/[^\/\\]+.jpg/);
                if (!match) alert('não encontrou...');
                else $('input[name=thumbTempProfile]').attr('value', match[0]);
            }
        }).submit();
    });
})

// CONTA QUANTIDADE DE IMAGENS SELECIONADAS
function contaCheckbox(selecionados){
  var inputs, x, selecionados=0;
  inputs = document.getElementsByClassName('Vj-lm');
  for(x=0;x<inputs.length;x++){
    selecionados++;
  }
  return selecionados;
}
// CAPTURA OS VALORES E SOMA
function pegaQuantidade(){
  var total; 
  total = contaCheckbox();
  if (total > 0){
    return total;        
  }else{
    return '0';
  } 
}

//VIEW GALLERY - UPLOAD FILLE
$(document).ready(function() {
    $("li#mBoxFilterGallery").click(function(){
        var butDate = $(this).attr("but-date");
        var gallery = $('.gallery-viewBox');
        var upload  = $('.upload-new-file');
        if(butDate == 'gallery'){
            upload.css('display','none');
            gallery.css('display','block');
            viewReturneThumb();
        } else {
            upload.css('display','block');
            gallery.css('display','none');
        }
    });

    $("li.dataThumb").live("click", function(){
        if( $(this).hasClass( "Vj-lm" ) ){
            $(this).removeClass('Vj-lm');
            $("span.add-file").fadeOut('fast');
        } else {
            var selected_activities = $('.Vj-lm');
            selected_activities.each(function(){
                selected_activities.removeClass('Vj-lm');
            });

            $(this).addClass('Vj-lm');
            $("span.add-file").fadeIn('fast');
        }
    });

    $("span.add-file").click(function(){
        var selected_activities = $('ul.listGalleryThumb li.Vj-lm');
        selected_activities.each(function(){
            var dataThumb = $(this).attr("data-thumb-id");

            var bg = $(this).find("div.viewListThumb").css('background-image');
            bg = bg.replace('url(','').replace(')','');

            $("div#editor").prepend('<img src=' + bg + ' style="width:40%;"><br>');

            var modal = document.getElementById('myModal');
            modal.style.display = "none";
            $('body').removeAttr('style'); 
        });
    });
});

// FUNÇÃO (DELETAR IMAGENS)
$(document).ready(function() {
    $(".lg-margThumb").live("click", function(){
        if( $('.thumbBox').hasClass( "Vj-lm" ) ){
            $('#btn').css('display','inline');
            $('#btn').html('imagens (' + pegaQuantidade() + ')');
        } else {
            $('#btn').css('display','none');
        }
    });

    $(".lg-margThumb").click(function(){
        var tID = $(this).attr("data-thumb-id");
        if( $(this).find('.thumbBox').hasClass( "Vj-lm" ) ){
            $(this).find('.thumbBox').removeClass('Vj-lm');
        } else {
            $(this).find('.thumbBox').addClass('Vj-lm');
        }
    });

    var ids = new Array();
    $('#btn').click(function () { 
        var selected_activities = $('.Vj-lm');
        var ids = new Array();
        selected_activities.each(function(){
              var id_str  =  $(this).attr("id");
              var id_arr  =  id_str;
              var selval  =  id_arr;
            if(selval!='undefined' && selval!='' && selval!=null){
                ids.push(selval);
            }
        });
        var formData = {
            'wfox_api'    : 'upload',
            'wfox_form'   : 'delet',
            'thumbIDS'    : ids,
        };
        $.ajax({
            type: 'POST',
            url: url_log + '/define_log.php',
            data: formData,
            cache: false,
            beforeSend: function() {
                $('#btn').html('<img class="load_img-dark" src="' + url_adm + '/assets/images/load/loadG1ae45f.png">');
            },
            success : function(html){
                window.location = url_adm + "/index.php?action=gallery&result=add-success";
            },
            error: function(xhr) {
                alert('ERROR::DELET_THUMB');
            }
        });
    });
});