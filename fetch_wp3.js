function post(){

    var name = document.getElementById("name").value;
    var date = document.getElementById("date").value;
    var id = document.getElementById("id").value;

    var requrl = "http://172.16.140.128/~user/ProjectWebAdvanced/ApiLudo.php?table=event&name=" + name + "&date=" + date + "&person_id=" + id;

    var request = new Request(requrl, {
        method: 'POST'
    });

    fetch(request).catch(function (err) {
        console.log(err.message);
    });
}

function get(){


    var request = new Request('http://172.16.140.128/~user/ProjectWebAdvanced/ApiLudo.php?table=event', {
        method: 'GET'
    });

    fetch(request).then(function (response) {
        return response.json();
    }).then(function (response2) {

        var events = new Array();

        for (var i = 0; i < response2.length; i++) {
            events.push(JSON.stringify(response2[i]));
        }



    }).catch(function (err) {
        console.log(err.message);
    });
}