@extends('portal.template.app')
@section('main-content')
   <div class="container" id="app">
       <div class="row">
           <h1>Test</h1>
           <p>
               <script type="text/javascript">
                   document.write( Lang.get('auth.failed') );
               </script>
           </p>
       </div>
   </div>
@endsection