


<section class="col-12 col-md-3 my-3 my-md-0">
    <form class="container d-flex justify-content-center mt-5" method="POST" action="{{ route('users/{id}/rate', ['id' => $user->user_id]) }}">
        <div class="card text-center mb-5">
                <h6 class="mb-0">Rate this seller</h6>
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
    </form>
    
</section>

<style>
.rating {
    display: flex;
    flex-direction: row-reverse;
    justify-content: center
}

.rating>input {
    display: none
}

.rating>label {
    position: relative;
    width: 1em;
    font-size: 30px;
    font-weight: 300;
    color: #FFD600;
    cursor: pointer
}

.rating>label::before {
    content: "\2605";
    position: absolute;
    opacity: 0
}

.rating>label:hover:before,
.rating>label:hover~label:before {
    opacity: 1 !important
}

.rating>input:checked~label:before {
    opacity: 1
}

.rating:hover>input:checked~label:before {
    opacity: 0.4
}
</style>
