$(function(){
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
            $('.top-title').html('Search Jobs')
        }else if(val == 'company'){
            company();
            $('.top-title').html('Search Company')
        }else if(val == 'candidate'){
            candidate();
            $('.top-title').html('Search Candidate')
        }else if(val == 'job_description'){
            job_description();
            $('.top-title').html('Search Job Description')
        }
    })
    
    function jobs(){ 
        let selector =  $('.input__search .form-control');
        selector.attr('placeholder', 'Find Job: title, keywords'); 
        selector.attr('name', 'job'); 
        $('.job_search').show();
        $('#category').attr('disabled', false)
        $('#experience').attr('disabled', false)
        $('.advanced__seach_show').slideDown();  
        $('.advanced__seach_show').find('.text__alert').remove();
        $('.job_search_candidate').hide();  
    }
    function company(){
        let selector =  $('.input__search .form-control');
        selector.attr('placeholder', 'Find Company: name, keywords'); 
        selector.attr('name', 'company');
        $('.job_search_candidate').hide();  
        hidden()
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
    }
    function job_description(){
        let selector =  $('.input__search .form-control');
        selector.attr('placeholder', 'Find job description: title, keywords'); 
        selector.attr('name', 'job_description'); 
        hidden()
    }
    function hidden (){
        $('.advanced__seach_show').hide();  
        $('.advanced__seach_show').find('.text__alert').remove();
        $('.job_search').hide();
        $('#category').attr('disabled', true)
        $('#experience').attr('disabled', true) 
        $('.advanced__seach_show').append('<span class="text-danger text__alert">Not found advanced search</span>')
        $('.job_search_candidate').hide();
        $('.job_search_candidate #category').attr('disabled', true)
    }
    $('.advanced__search_btn').click(function(){
        $('.advanced__seach_show').slideToggle();
    })
});

let searchParams = new URLSearchParams(window.location.search)
if(searchParams.has('candidate')){
    let selector =  $('.input__search .form-control');
    selector.attr('placeholder', 'Find Candidate: name, keywords'); 
    $('.top-title').html('Search Candidate')
    $('.breadcrumb-item.active').html('Search Candidate') 
    
    $('#cadidateSearchForm').attr('action','/jobs/search')
}
if(searchParams.has('company')){
    let selector =  $('.input__search .form-control');
    selector.attr('placeholder', 'Find Company: name, keywords'); 
    $('.top-title').html('Search Company')
    $('#employerSearchForm').attr('action','/jobs/search')
}
if(searchParams.has('job_description')){
    let selector =  $('.input__search .form-control');
    selector.attr('placeholder', 'Find job description: title, keywords'); 
    $('.top-title').html('Search Job Description')
    $('#JobDesSearchForm').attr('action','/jobs/search')
}
