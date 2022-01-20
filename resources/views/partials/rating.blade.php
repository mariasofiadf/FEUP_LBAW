
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<!--<form class="container d-flex justify-content-center mt-5" method="POST" action="{{ route('users/{id}/rate', $user->user_id) }}">
{{ csrf_field() }}    
        <div class="card text-center mb-5">

            <div class="rating"> 
                <input type="radio" name="rating" value="5" id="5">
                <label for="5">☆</label> 
                <input type="radio" name="rating" value="4" id="4">
                <label for="4">☆</label> 
                <input type="radio" name="rating" value="3" id="3">
                <label for="3">☆</label> 
                <input type="radio" name="rating" value="2" id="2">
                <label for="2">☆</label> 
                <input type="radio" name="rating" value="1" id="1">
                <label for="1">☆</label> 
            </div>
            <button type ="submit" class="btn btn-primary" >Rate</button> 
            <div class="d-flex flex-column">
                <span class=" text-center mb-5">Total rating: {{ $user->rating }}</span>
            </div>
    </div>
</form>-->
    <form class="container d-flex  mt-5 rate_user h-50" >
    {{ csrf_field() }} 
            <div class="card text-center mb-5" style = "border: none">
                <div class="rating"> 
                    <input type="radio" name="rating" value="5" id="5">
                    <label for="5">☆</label> 
                    <input type="radio" name="rating" value="4" id="4">
                    <label for="4">☆</label> 
                    <input type="radio" name="rating" value="3" id="3">
                    <label for="3">☆</label> 
                    <input type="radio" name="rating" value="2" id="2">
                    <label for="2">☆</label> 
                    <input type="radio" name="rating" value="1" id="1">
                    <label for="1">☆</label> 
                </div>
                <button type ="submit" class="btn btn-primary" >Rate</button> 
                <div class="d-flex flex-column">
                    <span class=" text-center mb-5 totalRating">Total rating: {{ $user->rating }}</span>
                </div>
        </div>
    </form>
    
