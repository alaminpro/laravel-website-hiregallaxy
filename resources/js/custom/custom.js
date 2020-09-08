$(function(){  
        
    var token = $('meta[name=csrf_token]').attr('content'); 



     $( "#datepicker" ).datepicker({
        dateFormat: "yy-mm-dd"
    }); 
  
    $('#sidebar_btn').click(function(){
        $("#sidebar").removeClass("turn-off");
        $("#sidebar").addClass("active");
        $("#sidebar_btn").addClass("btn-close"); 
        $("#sidebar_close").addClass("btn-active"); 
        $('.control__nav').addClass('control__item')
    })
    $('#sidebar_close').click(function(){
        $("#sidebar").removeClass("active");
		$("#sidebar").addClass("turn-off");
		$("#sidebar_btn").removeClass("btn-close");
		$("#sidebar_btn").addClass("btn-active");
        $("#sidebar_close").removeClass("btn-active");
        $('.control__nav').removeClass('control__item')
    })

    $('.custom__search_bar .dropdown-item').click(function(){
        let el = $(this);
        let val =el.attr('data-id');
        if(val == 'jobs'){
            jobs()
            $('.changes_dynamic_title').html('Search Jobs')
            $('.breadcrumb-item.active').html('Jobs')
        }else if(val == 'company'){
            company();
            $('.changes_dynamic_title').html('Search Company')
            $('.breadcrumb-item.active').html('Search Company')
        }else if(val == 'candidate'){
            candidate();
            $('.changes_dynamic_title').html('Search Candidate')
            $('.breadcrumb-item.active').html('Search Candidate')
        }else if(val == 'job_description'){
            job_description();
            $('.changes_dynamic_title').html('Search Job Description')
            $('.breadcrumb-item.active').html('Search Job Description')
        }
    })
    
    function jobs(){ 
        let selector =  $('.input__search .form-control');
        selector.attr('placeholder', 'Find Job: title, keywords'); 
        selector.attr('name', 'job'); 
        $('.job_search').show();
        $('#category').attr('disabled', false)
        $('#experience').attr('disabled', false)
        $('#type').attr('disabled', false)
        $('#datepicker').attr('disabled', false)
        $('.advanced__seach_show').slideDown();  
        $('.advanced__seach_show').find('.text__alert').remove();
        $('.job_search_candidate').hide();  
        $('.job_search_company').hide();  
    }
    function company(){
        let selector =  $('.input__search .form-control');
        selector.attr('placeholder', 'Find Company: name, keywords'); 
        selector.attr('name', 'company');
        $('.job_search_candidate').hide();
          
        hidden()
        $('.advanced__seach_show').slideDown();  
        $('.job_search_company').show();  
        $('#sector').attr('disabled', false)
        $('.job_search_company .dropdown-toggle').removeClass('disabled')  
        $('.advanced__seach_show').find('.text__alert').remove();
    }
    function candidate(){
        let selector =  $('.input__search .form-control');
        selector.attr('placeholder', 'Find Candidate: name, keywords'); 
        selector.attr('name', 'candidate');  
        hidden()
        $('.advanced__seach_show').slideDown();  
        $('.advanced__seach_show').find('.text__alert').remove();
        $('.job_search_candidate').show();  
        $('.job_search_candidate #category').attr('disabled', false) 
        $('.job_search_candidate #experience').attr('disabled', false) 
        $('.job_search_candidate .dropdown-toggle').removeClass('disabled') 
        $('.job_search_candidate .dropdown-toggle').removeClass('disabled')  
    }
    function job_description(){
        let selector =  $('.input__search .form-control');
        selector.attr('placeholder', 'Find job description: title, keywords'); 
        selector.attr('name', 'job_description'); 
        hidden()
        $('.input__search').addClass('input__search_description');  
        $('.input__city').addClass('input__city_description'); 
        $('.input__city .form-control').attr('disabled',true);
    }
    function hidden (){
        $('.advanced__seach_show').hide();  
        $('.advanced__seach_show').find('.text__alert').remove();
        $('.job_search').hide();
        $('#category').attr('disabled', true)
        $('#experience').attr('disabled', true) 
        $('#datepicker').attr('disabled', true) 
        $('#type').attr('disabled', true) 
        $('#sector').attr('disabled', true)
        $('.advanced__seach_show').append('<span class="text-danger text__alert">Not found advanced search</span>')
        $('.job_search_candidate').hide();
        $('.job_search_company').hide();
        $('.job_search_candidate #category').attr('disabled', true);
        $('.job_search_candidate #experience').attr('disabled', true);
        $('.input__search').removeClass('input__search_description');  
        $('.input__city').removeClass('input__city_description'); 
        $('.input__city .form-control').removeAttr('disabled');
    }
    $('.advanced__search_btn').click(function(){
        $('.advanced__seach_show').slideToggle();
    })




    function isHTML(str) {
        var a = document.createElement('div');
        a.innerHTML = str;

        for (var c = a.childNodes, i = c.length; i--; ) {
            if (c[i].nodeType == 1) return true;
        }

        return false;
    }

    $(document).on('click','.conversations .message-box .delete_conversation', function (event) {
        var el = $(event.currentTarget);
        var id = el.attr('data-id');
        var receive_id = el.attr('data-receive');
        var conf = confirm('Are you sure?');
        if(conf) {
            $.ajax({
                url: ajax_url,
                data: {action: 'delete_conversation', id: id, _token: token},
                dataType: 'JSON',
                type: 'POST',
                success: function (res) {
                    if (res.status === 'success') {
                        $('.conversations .message-box').empty();
                        $('#conversation-' + id).remove(); 
                    } else if (res.status === 'login') {
                        $('.modal').modal('hide');
                        $('#modalLogin').modal('show');
                    }
                }
            })
        }
    });

  
 
    $(document).on('click','.seen--message',function (event) {
        event.preventDefault();
        $.ajax({
            url: ajax_url,
            data: { action: 'seen', _token: token},
            dataType: 'JSON',
            type: 'POST',
            success: function (res) {
                if(res.status == 'success'){
                    window.location.href  = res.route;
                }
            }
        });
    });
    $(document).on('keyup','.conversations .message-box input.message-input',function (event) {
        event.preventDefault();
        var el = $(event.currentTarget);
        var keycode = (event.keyCode ? event.keyCode : event.which);
        var id = el.attr('data-id');
        var receive_id = el.attr('data-receive');
        var sender_id = el.attr('data-sender');
        var sender_name = el.attr('data-sendername'); 
        if (keycode === 13) { 
            var message = el.val();
            $.ajax({
                url: ajax_url,
                data: {action: 'send_message', id: id, text: message, _token: token},
                dataType: 'JSON',
                type: 'POST',
                success: function (res) {
                    el.val('');
                    if(res.status === 'success'){
                        $('#conversation-'+id).each(function () {
                            $(this).parent().prepend(this);
                        });
                        $('.message-box .list-messages ul .mCSB_container').append(res.html);
                        $('.no_conversiation').remove();
                        $('#conversation-'+id).find('p').html('You: '+message);
                        $('.message-box .list-messages ul').mCustomScrollbar("scrollTo","bottom",{scrollInertia:0});  
                            $.ajax({
                                url: ajax_url,
                                data: { action: 'seen', _token: token},
                                dataType: 'JSON',
                                type: 'POST',
                                success: function (res) {
                                    if(res.status == 'success'){
                                        window.location.href  = res.route;
                                    }
                                }
                            });
                           
                    }
                    else if(res.status === 'login'){
                        $('.modal').modal('hide');
                        $('#signInModal').modal('show');
                    }
                    else if(res.status === 'wait'){
                        $('.message-box .write-message').addClass('waiting');
                    }
                }
            })
        } 
    });


    $(document).on('click','.conversations .icon__sending i',function (event) {
        event.preventDefault();
        var el = $('.message-input');
        var keycode = (event.keyCode ? event.keyCode : event.which);
        var id = el.attr('data-id');
        var receive_id = el.attr('data-receive');
        var sender_id = el.attr('data-sender');
        var sender_name = el.attr('data-sendername');  
            var message = el.val();
            $.ajax({
                url: ajax_url,
                data: {action: 'send_message', id: id, text: message, _token: token},
                dataType: 'JSON',
                type: 'POST',
                success: function (res) {
                    el.val('');
                    if(res.status === 'success'){
                        $('#conversation-'+id).each(function () {
                            $(this).parent().prepend(this);
                        });
                        $('.message-box .list-messages ul .mCSB_container').append(res.html);
                        $('.no_conversiation').remove();
                        $('#conversation-'+id).find('p').html('You: '+message);
                        $('.message-box .list-messages ul').mCustomScrollbar("scrollTo","bottom",{scrollInertia:0});  
                            $.ajax({
                                url: ajax_url,
                                data: { action: 'seen', _token: token},
                                dataType: 'JSON',
                                type: 'POST',
                                success: function (res) { 
                                }
                            });
                           
                    }
                    else if(res.status === 'login'){
                        $('.modal').modal('hide');
                        $('#signInModal').modal('show');
                    }
                    else if(res.status === 'wait'){
                        $('.message-box .write-message').addClass('waiting');
                    }
                }
            }) 
    });


    $(document).on('click', '.conversations .list-conversations .conversation-item', function (event) {
        var el = $(event.currentTarget);
        var id = el.attr('data-id');
        $.ajax({
            url:ajax_url,
            data: {action: 'load_conversation', id: id, _token: token},
            dataType: 'JSON',
            type: 'POST',
            success: function (res) {
                if(res.status === 'success'){
                    functionHide(); 
                    $('.conversations .list-conversations .conversation-item').removeClass('active');
                    el.addClass('active');
                    $('.conversations .message-box').empty();
                    $('.conversations .message-box').append(res.html); 
                    if(res.unread === 0){
                        $('#message-sidebar .badge').empty()
                    }
                    else{
                        $('#message-sidebar .badge').text(res.unread);
                    }
                    window.history.pushState({}, null, res.url);
                    $('.conversations .message-box .list-messages ul').mCustomScrollbar().mCustomScrollbar("scrollTo","bottom",{scrollInertia:0});
                   }
            }
        })
    });

    function functionHide() {
        if (navigator.userAgent.match(/Android/i)
            || navigator.userAgent.match(/webOS/i)
            || navigator.userAgent.match(/iPhone/i)

            || navigator.userAgent.match(/BlackBerry/i)
            || navigator.userAgent.match(/Windows Phone/i)
        )
        {
            $('.conversation-item').removeClass('active');
            $('.list-conversations').hide();
            $('.list-conversations').hide("slide", { direction: "left" }, 1000);
            $('.message-box').show();
        } 
    }
 


    $('.list-messages ul li.load_more_message').click(function (event) {
        var el = $(event.currentTarget);
        var page = el.attr('data-page');
        page = parseInt(page)+1;
        var id = el.attr('data-id');
        $.ajax({
            url:ajax_url,
            data: {action: 'load_messages', page: page, id: id, _token: token},
            dataType: 'JSON',
            type: 'POST',
            success: function (res) {
                if(res.status === 'success'){
                    el.after(res.html);
                    el.attr('data-page', page);
                }
                else if(res.status === 'empty'){
                    el.remove();
                }
            }
        })
    });

    if($('.conversations .message-box .list-messages ul').length){
        $('.conversations .message-box .list-messages ul').mCustomScrollbar().mCustomScrollbar("scrollTo","bottom",{scrollInertia:0});
    }
    if($('.conversations .list-conversations ul').length){
        $('.conversations .list-conversations ul').mCustomScrollbar().mCustomScrollbar();
    }



    
});

let searchParams = new URLSearchParams(window.location.search)
if(searchParams.has('candidate')){ 
    let selector =  $('.input__search .form-control');
    selector.attr('placeholder', 'Find Candidate: name, keywords'); 
    selector.attr('name', 'candidate'); 
    $('.changes_dynamic_title').html('Search Candidate')
    $('.breadcrumb-item.active').html('Search Candidate') 
    $('#experience').attr('disabled', true) 
    $('.job_search').hide();
    $('#cadidateSearchForm').attr('action','/jobs/search')
     $('.job_search_candidate').show(); 
    $('.job_search_candidate #category').attr('disabled', false) 
    $('.job_search #category').attr('disabled', true) 
    $('.job_search #experience').attr('disabled', true)  
    $('#sector').attr('disabled', true)
    $('#datepicker').attr('disabled', true) 
    $('#type').attr('disabled', true) 
}
if(searchParams.has('company')){
    $('.job_search_company').show(); 
    let selector =  $('.input__search .form-control');
    selector.attr('placeholder', 'Find Company: name, keywords'); 
    $('.breadcrumb-item.active').html('Search Company')
    selector.attr('name', 'company'); 
    $('.changes_dynamic_title').html('Search Company')
    $('#employerSearchForm').attr('action','/jobs/search') 
    $('.job_search').hide();
    $('#sector').attr('disabled', false)
    $('#datepicker').attr('disabled', true) 
    $('#type').attr('disabled', true) 
    $('#category').attr('disabled', true)
    $('#experience').attr('disabled', true) 
}
if(searchParams.has('job_description')){
    $('.advanced__seach_show').append('<span class="text-danger text__alert">Not found advanced search</span>')
    let selector =  $('.input__search .form-control');
    selector.attr('placeholder', 'Find job description: title, keywords');  
    selector.attr('name', 'job_description'); 
    $('.changes_dynamic_title').html('Search Job Description')
    $('.breadcrumb-item.active').html('Search Job Description')
    $('#JobDesSearchForm').attr('action','/jobs/search')
    $('.input__search').addClass('input__search_description');  
    $('.input__city').addClass('input__city_description'); 
    $('.input__city .form-control').attr('disabled',true);
    $('.job_search').hide();
    $('#category').attr('disabled', true)
    $('#experience').attr('disabled', true) 
    $('#sector').attr('disabled', true)
    $('#datepicker').attr('disabled', true) 
    $('#type').attr('disabled', true) 
}


