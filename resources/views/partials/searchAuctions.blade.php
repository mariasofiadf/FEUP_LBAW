
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

  .searchFilter .btn {
    min-width: 172px;  
  }
  .searchFilter .label-icon {
    display: inline-block;  
  }


}

</style>

<form method="GET" action="{{ route('search') }}">

    <div class="row justify-content-center">
        <div class="align-items-center input-group m-4 w-50 mb-3 col-1">
            <label for="query" class="form-label" ></label>
            <input type="text" name="query" class="form-control rounded"  placeholder="Keyword"  id="query"aria-label="Search"
            aria-describedby="search-addon">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </div>
    
</form>
<form  method="GET" action="{{ route('search') }}">
{{ csrf_field() }}
<div class="container">
  <div class="row searchFilter" >
     <div class="col-sm-12" >
      <div class="input-group" >
      <label for="query" class="form-label" ></label>
      <input type="text" name="query" class="form-control rounded"  placeholder="Keyword"  id="query"aria-label="Search"
        aria-describedby="search-addon">
       <div class="input-group-btn" >
        <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" ><span class="label-icon" >Category</span> <span class="caret" >&nbsp;</span></button>
        <div class="dropdown-menu dropdown-menu-right" >
           <ul class="category_filters" >
            <li >
             <input class="cat_type category-input" data-label="All" id="all" value="" name="radios" type="radio" ><label for="all" >All</label>
            </li>
            <li >
             <input type="radio" name="radios" id="Design" value="Design" ><label class="category-label" for="Design" >Design</label>
            </li>
           </ul>
        </div>
        <button type="submit" class="btn btn-primary">Search</button>   
       </div>
      </div>
     </div>
  </div>
</div>
    
</form>

