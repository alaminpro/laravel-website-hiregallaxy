$(function(){ 
     $( "#datepicker" ).datepicker({
        dateFormat: "yy-mm-dd"
    }); 

    $('#sidebar_btn').click(function(){
        $("#sidebar").removeClass("turn-off");
        $("#sidebar").addClass("active");
        $("#sidebar_btn").addClass("btn-close"); 
        $("#sidebar_close").addClass("btn-active"); 
    })
    $('#sidebar_close').click(function(){
        $("#sidebar").removeClass("active");
		$("#sidebar").addClass("turn-off");
		$("#sidebar_btn").removeClass("btn-close");
		$("#sidebar_btn").addClass("btn-active");
		$("#sidebar_close").removeClass("btn-active");
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
