<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!--Font Awesome-->
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/font-awesome/web-fonts-with-css/css/fontawesome-all.css')}}">
    
    <!--Select 2-->
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/dist/css/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/dist/css/select2-bootstrap4.min.css')}}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        @include('inc.navbar')
        <main class="py-4">
            <div class="container">
                @include('inc.messages')
                @yield('content')
            </div>
        </main>
    </div>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('plugins/select2/dist/js/select2.min.js')}}"></script>

    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'article-ckeditor' );
    </script>

    <!--Assign User form script-->
    <script type="text/javascript">
      $(document).ready(function(){
        $('.select').select2();

        $(document).on('change','#locations',function(){      
          var loc_id = $(this).val();
          var bank_id = $('#banks').val();

          $('#branches').children().remove();
          $('#branches').append($('<option>', {
             text: 'Select Branch',
             selected: true,
             disabled: true
          }));

          $.ajax({
            type:'GET',
            url:'{!!URL::to('findBranches')!!}',
            data:{
              'loc_id':loc_id,
              'bank_id':bank_id
            },
            success:function(data){
              if(data.length>0) {
                $('#branches').children().remove();
                $('#branches').append($('<option>', {
                   text: 'Select Branch',
                   selected: true,
                   disabled: true
                }));            
                
                for(var i=0; i< data.length; i++) {
                  $('#branches').append($('<option>', { 
                      value: data[i].branch_id,
                      text : data[i].branch_name
                  }));            
                }
              }else {
                $('#branches').children().remove();
                $('#branches').append($('<option>', {
                   text: 'No Branch Found',
                   selected: true,
                   disabled: true
                }));
              } 
            },
            error:function(){

            }
          });      
        });

        $(document).on('change','#banks',function(){      
          var bank_id = $(this).val();
          var loc_id = $('#locations').val();

          $.ajax({
            type:'GET',
            url:'{!!URL::to('findBranches')!!}',
            data:{
              'loc_id':loc_id,
              'bank_id':bank_id
            },
            success:function(data){
              if(data.length>0) {
                $('#branches').children().remove();
                $('#users').children().remove();            
                $('#branches').append($('<option>', {
                   text: 'Select Branch',
                   selected: true,
                   disabled: true
                }));            
                
                for(var i=0; i< data.length; i++) {
                  $('#branches').append($('<option>', { 
                      value: data[i].branch_id,
                      text : data[i].branch_name
                  }));            
                }
              }else {
                $('#branches').children().remove();
                $('#branches').append($('<option>', {
                   text: 'No Branch Found',
                   selected: true,
                   disabled: true
                }));
              }          
            },
            error:function(){

            }
          });
        });

        $(document).on('change','#branches',function(){
          var branch_id = $(this).val();
          console.log(branch_id);          

          $.ajax({
            type:'GET',
            url:'{!!URL::to('findUserBranches')!!}',
            data:{
              'branch_id':branch_id
            },
            success:function(data){
              if(data.length>0) {
                $('#users').children().remove();
                $('#users').append($('<option>', {
                   text: 'Select User',
                   selected: true,
                   disabled: true
                }));            
                
                for(var i=0; i< data.length; i++) {
                  var mname = data[i].mname;
                  $('#users').append($('<option>', { 
                      value: data[i].id,
                      text : [data[i].fname+' '+mname.charAt(0)+'. '+data[i].lname]
                  }));            
                }
              }else {
                $('#users').children().remove();
                $('#users').append($('<option>', {
                   text: 'No Users Found',
                   selected: true,
                   disabled: true
                }));
              }          
            },
            error:function(){

            }
          });      
        });

      });
    </script>
    <!--Assign User form script-->             
</body>
</html>
