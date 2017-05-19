/**
 * Created by Davide Pavone on 19/05/2017.
 */
var request = new Request('http://192.168.118.148/~user/Project/ApiLudo.php?table=events', {
    method: 'GET'
});

 fetch(request).then(function (response) {
     return response.json();
 }).then(function(response2){
     console.log('JSON: ', response2);
 }).catch(function (err) {
     console.log(err.message);
     console.log('fataal!!!!');
 });