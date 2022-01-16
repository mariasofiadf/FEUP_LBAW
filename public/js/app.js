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
  let container = auction.querySelector('div.container');
  container.prepend(new_bid);

  // Reset the new item form
  form.querySelector('[type=number]').value=0;
}

function createBid(bid) {
  let new_bid = document.createElement('div');
  new_bid.classList.add('row');
  new_bid.classList.add('justify-content-left');
  new_bid.setAttribute('data-id', bid.bid_id);
  new_bid.innerHTML = `
    <div class="card sm" style="width: auto; margin-right: 1rem;">
      <div class="card-body">
        <div class= "justify-content-center">
        <h4 class="card-text">${ bid.bid_value }€ by ${ bid.bidder ?? ''}</a></h4>
        <p class="card-text"> ${ bid.bid_date }</a></p>
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
  //if (this.status != 200) window.location = '/';
  let new_follow = document.getElementById('follow');

  new_follow.id = 'follow';
  new_follow.innerHTML = `Unfollow`;
  new_follow.className = "btn btn-primary unfollow";
  return new_follow;
}


function sendDeleteFollowRequest(event) {
  let id = this.closest('article').getAttribute('data-id');
  console.log("Unfollowing");

  sendAjaxRequest('delete', '/api/auctions/' + id + '/follow', {}, followDeletedHandler);

  event.preventDefault();
}

function followDeletedHandler() {
  //if (this.status != 200) window.location = '/';
  let new_follow = document.getElementById('follow');
  new_follow.id = 'follow';
  new_follow.innerHTML = `Follow`;
  new_follow.className = "btn btn-primary follow";
  return new_follow;
}


console.log("Added event listeners");
addEventListeners();
