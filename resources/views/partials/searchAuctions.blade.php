
<style>
.searchFilter {
  margin-bottom: 20px;    
}
 .searchFilter.btn {
    display: inline-block;
    font-weight: 400;
    line-height: 1.25;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    border: 1px solid transparent;
    padding: .5rem 1rem;
    font-size: 16px;
    border-radius: .25rem;
    height: 50px;
    min-width: 20px;
}
.searchFilter .btn-secondary {
    color: #373a3c;
    background-color: #fff;
    border: 1px solid #ccc;
}
.searchFilter .btn-secondary:hover {
    color: #373a3c;
    background-color: #e6e6e6;
    border-color: #adadad;
}
.searchFilter .btn-search {
  background-color: #00aced;
  color: #fff;
  border: 1px solid #00aced;
}
.searchFilter .btn-search:hover {
  background-color: #b20a11;
  color: #fff;
  border: 1px solid #b20a11;
}
.searchFilter .label-icon {
  display: none;  
}
.searchFilter .glyphicon {
    margin-right: -15px;
}

@media (min-width: 1400px) {
  .ct-header .ct-jumbotron .inner {
    max-width: 470px;
    min-height: 230px;
  }  
}
@media (max-width: 1400px) {
  .ct-header-slider .item {
    background-size:contain;
    background-repeat: no-repeat;
    background-position: center top;
  }  
}
@media (min-width: 769px) and (max-width: 1400px) {
  .ct-header-slider .item {
    height: auto;  
  }
}
@media (max-width: 1260px) {
  #dots-container {
    display: none;
  }
}
@media (min-width: 992px){
  .ct-footer2 .ct-newsletter {
    max-width: 100%;
  }
  #dots-container {
    bottom: 100px;
  } 
}
@media (min-width: 768px){

  .searchFilter .form-select {
    min-width: 172px;
    max-width: 100px;
  }

}

</style>
<form  method="GET" action="{{ route('search') }}">
{{ csrf_field() }}
<div class="container">
  <div class="row searchFilter" >
     <div class="col-sm-12" >
      <div class="input-group" >
        <label for="query" class="form-label" ></label>
        <input type="text" name="query" class="form-control rounded"  placeholder="Keyword"  id="query"aria-label="Search"
        aria-describedby="search-addon">
        <select name = "category" class="form-select" aria-label="Default select example">
            <option disabled selected>Select Category</option>
            <option value="ArtPiece">ArtPiece</option>
            <option value="Book">Book</option>
            <option value="Jewelry">Jewelry</option>
            <option value="Decor">Decor</option>
            <option value="Other">Other</option>
        </select>
       <div class="input-group-btn" >
       
        <button type="submit" class="btn btn-primary">Search</button>   
       </div>
      </div>
     </div>
  </div>
</div>
    
</form>



