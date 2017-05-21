/**
 * Created by Davide Pavone on 19/05/2017.
 */

document.getElementById("Post_Data").addEventListener("click", function () {
    var request = new Request('http://192.168.118.148/~user/Project/ApiLudo.php?table=event&name=wp3&date=2045-02-03&person_id=1', {
        method: 'POST'
    });

    fetch(request).catch(function (err) {
        console.log(err.message);
    });

//hier moet er een second of 2 pauze zijn zodat die post altijd wordt weergegeven
});

document.getElementById("Get_Data").addEventListener("click", function () {
    var request = new Request('http://192.168.118.148/~user/Project/ApiLudo.php?table=event', {
        method: 'GET'
    });

    fetch(request).then(function (response) {
        return response.json();
    }).then(function (response2) {
        console.log('JSON: ', response2);
        for (var i = 0; i < response2.length; i++) {
            console.log(response2[i]);
            document.write(JSON.stringify(response2[i]));
        }
    }).catch(function (err) {
        console.log(err.message);
    });
})