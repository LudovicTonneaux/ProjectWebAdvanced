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
            events.push(response2[i]);
        }

       var html = "<table><tr><th>ID</th><th>Name</th><th>Date</th><th>Person ID</th></tr>";

        for (var i = 0; i < events.length; i++) {
            html += "<tr>";
            html += "<td>";
            html += events[i].id;
            html += "</td>";
            html += "<td>";
            html += events[i].name;
            html += "</td>";
            html += "<td>";
            html += events[i].date;
            html += "</td>";
            html += "<td>";
            html += events[i].person_id;
            html += "</td>";
            html += "</tr>";

        }
        html += "</table>";
        document.getElementById("showEvents").innerHTML = html;

    }).catch(function (err) {
        console.log(err.message);
    });
}