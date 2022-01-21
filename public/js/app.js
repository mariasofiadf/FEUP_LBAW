function addEventListeners(){

  let bidCreators = document.querySelectorAll('article.auction form.new_bid');
  [].forEach.call(bidCreators, function(creator) {
    creator.addEventListener('submit', sendCreateBidRequest);
  });

  let followCreators = document.querySelectorAll('article.auction a.follow');
  [].forEach.call(followCreators, function(creator) {
    creator.addEventListener('click', sendCreateFollowRequest);
  });

  let followDeleters = document.querySelectorAll('article.auction a.unfollow');
  [].forEach.call(followDeleters, function(deleter) {
    deleter.addEventListener('click', sendDeleteFollowRequest);
  });

  let ratingCreators = document.querySelectorAll('article.user form.rate_user');
  [].forEach.call(ratingCreators, function(creator) {
    creator.addEventListener('submit', sendCreateRatingRequest);
  });

}

function encodeForAjax(data) {
  if (data == null) return null;
  return Object.keys(data).map(function(k){
    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
  }).join('&');
}

function sendAjaxRequest(method, url, data, handler) {
  let request = new XMLHttpRequest();

  request.open(method, url, true);
  request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  request.addEventListener('load', handler);
  request.send(encodeForAjax(data));
}


function sendCreateBidRequest(event) {
  console.log("Sent bid req");
  let id = this.closest('article').getAttribute('data-id');
  let bid_value = this.querySelector('input[name=bid_value]').value;

  if (bid_value != '')
    sendAjaxRequest('put', '/api/auctions/' + id + '/bid', {bid_value: bid_value}, bidAddedHandler);

  event.preventDefault();
}

function bidAddedHandler() {
  //if (this.status != 200) window.location = '/';
  let bid = JSON.parse(this.responseText);

  // Create the new item
  let new_bid = createBid(bid);

  // Insert the new item
  let auction = document.querySelector('article.auction[data-id="' + bid.auction_id + '"]');
  let form = auction.querySelector('form.new_bid');
  let container = auction.querySelector('div.profile-bids');
  container.prepend(new_bid);

  // Reset the new item form  
  form.querySelector('[type=number]').value=0;
}

function createBid(bid) {
  let new_bid = document.createElement('div');
  new_bid.classList.add('container');
  new_bid.setAttribute('data-id', bid.bid_id);
  new_bid.innerHTML = `

    <div class="row">
    <div class="card sm m-1" style="margin-right: 1rem;">
      <div class="card-body">
            <h3 class="text">${ bid.bid_value }€ by ${ bid.bidder ?? ''}</h3>
            <span class="text-uppercase text-muted brand">${ bid.bid_date }</span>
      </div>
    </div>
    </div>

  `;

  return new_bid;
}


function sendCreateFollowRequest(event) {
  let id = this.closest('article').getAttribute('data-id');

  sendAjaxRequest('put', '/api/auctions/' + id + '/follow', {}, followAddedHandler);

  event.preventDefault();
}

function followAddedHandler() {
  //if (this.status != 201) window.location = '/';
  let old_follow = document.getElementById('follow');
  old_follow.remove();

  let follow = JSON.parse(this.responseText);

  let new_follow = document.createElement('a');
  new_follow.id = 'follow';
  new_follow.innerHTML = `Unfollow`;
  new_follow.className = "btn btn-outline-primary unfollow";

  let auction = document.querySelector('article.auction[data-id="' + follow.id_followed + '"]');
  let container = auction.querySelector('div.follow');
  container.prepend(new_follow);
  addEventListeners()
  return new_follow;
}


function sendDeleteFollowRequest(event) {
  let id = this.closest('article').getAttribute('data-id');
  console.log("Unfollowing");

  sendAjaxRequest('delete', '/api/auctions/' + id + '/unfollow', {}, followDeletedHandler);

  event.preventDefault();
}

function followDeletedHandler() {
  //if (this.status != 201) window.location = '/';
  let old_follow = document.getElementById('follow');
  old_follow.remove();

  let follow = JSON.parse(this.responseText);

  let new_follow = document.createElement('a');

  new_follow.id = 'follow';
  new_follow.innerHTML = `Follow`;
  new_follow.className = "btn btn-outline-primary follow";

  let auction = document.querySelector('article.auction[data-id="' + follow.id_followed + '"]');
  let container = auction.querySelector('div.follow');
  container.prepend(new_follow);
  addEventListeners()
  return new_follow;
}

function sendCreateRatingRequest(event) {
  console.log("Rating");
  let id = this.closest('article').getAttribute('data-id');
  let rating = this.querySelector('input[name=rating]:checked').value;
  
  if (rating != '')
    sendAjaxRequest('put', '/api/users/' + id + '/rate', {rating: rating}, ratingAddedHandler);

  event.preventDefault();
}


function ratingAddedHandler() {

  let user = JSON.parse(this.responseText);

  // // Create the new item
  // let new_bid = createBid(bid);

  // // Insert the new item
  let userPage = document.querySelector('article.user[data-id="' + user.user_id + '"]');
  let div = userPage.querySelector('div.rate-display');
  let h5 = div.querySelector('h5');
  // container.prepend(new_bid);
  h5.innerHTML='Rating: ' + user.rating;
  // // Reset the new item form
  // form.querySelector('[type=number]').value=0;
}

console.log("Added event listeners");
addEventListeners();
