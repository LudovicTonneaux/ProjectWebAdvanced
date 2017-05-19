/**
 * Created by Davide Pavone on 19/05/2017.
 */
// const url = 'http://192.168.118.148/~user/Project/ApiLudo.php?table=events';
// fetch(url).then((resp)=> resp.json()).then(function(data){
//     var events = data.results;
//     return events;
// }).catch(function(error){
//     console.log(JSON.stringify(error));
// });
var request = new Request('http://192.168.118.148/~user/Project/ApiLudo.php?table=events', {
    method: 'GET',
    mode: 'cors',
    headers: new Headers({
        'Content-Type': 'text/plain'
    })
});

 fetch(request).then(function (response) {
     // console.log('status: ', response.status);
     // console.log(response.json());
     //  console.log(response.toString());
     return response.json();
 }).then(function(response2){
     console.log('JSON: ', response2);
 }).catch(function (err) {
     console.log(err.message);
     console.log('fataal!!!!');
 });

// fetch(request)
//     .then(res => res.json())
// .then((out) => {
//     console.log('Checkout this JSON! ', out);
// })
// .catch(err => console.error(err));