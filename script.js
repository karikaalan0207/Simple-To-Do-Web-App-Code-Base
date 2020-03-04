
var usingnow = 'myday';
document.getElementById("useless").style.visibility = "hidden";
document.getElementById("useless").style.opacity = 0;
document.getElementById("info-box").style.visibility = "hidden";
document.getElementById("notuse").style.visibility = "hidden";
document.getElementById("notuse1").style.visibility = "hidden";
document.getElementById("notuse2").style.visibility = "hidden";
document.getElementById("overall").style.visibility = "visible";
var inuse;


function showinfo(ide) {

    document.getElementById("info-box").style.visibility = "visible";
    document.getElementById("info-box").style.opacity = 1;

    var n = ide[0].getAttribute("id");
    

    document.getElementById("infohead_h").innerHTML = n;
    
    inuse = n;
     
    $.ajax({
        
        type: 'GET',
        url : "retnote.php",
        data : {'task_name': n},
        proessData:false,
        dataType: 'json', 
        success: function(data)          //on recieve of reply
        {
            document.getElementById("nott").innerHTML = data.note;
        }  
     });


    

    // document.getElementById("nott").innerHTML = ns ;

}



function showinfo_t(ide) {

    document.getElementById("info-box").style.visibility = "visible";
    document.getElementById("info-box").style.opacity = 1;

    // var n = ide[0].getAttribute("id");
    
    console.log(ide.getAttribute("id"));

    document.getElementById("infohead_h").innerHTML = ide.getAttribute("id");
    
    var n = ide.getAttribute("id");
    inuse = n;
    
    $.ajax({
        
        type: 'GET',
        url : "retnote.php",
        data : {'task_name': n},
        proessData:false,
        dataType: 'json', 
        success: function(data)          //on recieve of reply
        {
            console.log(data.note);
            document.getElementById("nott").innerHTML = data.note;
        }  
     });

}


function hideinfo() {
    document.getElementById("info-box").style.visibility = "hidden";
    document.getElementById("info-box").style.opacity = 0;
}

function togglesidebar()
{
    document.getElementById("sidebar").classList.toggle("active");
    document.getElementById("mainarea").classList.toggle("actives");
}

function mydayvis()
{
    usingnow = 'myday';
    document.getElementById("myday").style.visibility = "visible";
    document.getElementById("myday").style.opacity = 1;
    document.getElementById("important").style.visibility = "hidden";
    document.getElementById("important").style.opacity = 0;
    document.getElementById("upcoming").style.visibility = "hidden";
    document.getElementById("upcoming").style.opacity = 0;
    document.getElementById("overall").style.visibility = "hidden";
    document.getElementById("overall").style.opacity = 0;
    document.getElementById("customtasklist").style.visibility = "hidden";
    document.getElementById("customtasklist").style.opacity = 0;
    document.getElementById("choose").style.visibility = "hidden";
}

function importantvis()
{   
    usingnow = 'important';
    document.getElementById("myday").style.visibility = "hidden";
    document.getElementById("myday").style.opacity = 0;
    document.getElementById("important").style.visibility = "visible";
    document.getElementById("important").style.opacity = 1;
    document.getElementById("upcoming").style.visibility = "hidden";
    document.getElementById("upcoming").style.opacity = 0;
    document.getElementById("overall").style.visibility = "hidden";
    document.getElementById("overall").style.opacity = 0;
    document.getElementById("customtasklist").style.visibility = "hidden";
    document.getElementById("customtasklist").style.opacity = 0;
    document.getElementById("choose").style.visibility = "hidden";
}

function upcomingvis()
{   
    usingnow = 'upcoming'
    document.getElementById("myday").style.visibility = "hidden";
    document.getElementById("myday").style.opacity = 0;
    document.getElementById("important").style.visibility = "hidden";
    document.getElementById("important").style.opacity = 0;
    document.getElementById("upcoming").style.visibility = "visible";
    document.getElementById("upcoming").style.opacity = 1;
    document.getElementById("overall").style.visibility = "hidden";
    document.getElementById("overall").style.opacity = 0;
    document.getElementById("customtasklist").style.visibility = "hidden";
    document.getElementById("customtasklist").style.opacity = 0;
    document.getElementById("choose").style.visibility = "hidden";
}


function overallvis()
{   

    

    usingnow = 'overall';
    document.getElementById("myday").style.visibility = "hidden";
    document.getElementById("myday").style.opacity = 0;
    document.getElementById("important").style.visibility = "hidden";
    document.getElementById("important").style.opacity = 0;
    document.getElementById("upcoming").style.visibility = "hidden";
    document.getElementById("upcoming").style.opacity = 0;
    document.getElementById("overall").style.visibility = "visible";
    document.getElementById("overall").style.opacity = 1;
    document.getElementById("customtasklist").style.visibility = "hidden";
    document.getElementById("customtasklist").style.opacity = 0;
    document.getElementById("choose").style.visibility = "hidden";

    
}



function customtasklistvis(id)
{   
    
    var idcurrent = id.getAttribute('id');
    usingnow = idcurrent;
    showdynamic(idcurrent);

    document.getElementById("myday").style.visibility = "hidden";
    document.getElementById("myday").style.opacity = 0;
    document.getElementById("important").style.visibility = "hidden";
    document.getElementById("important").style.opacity = 0;
    document.getElementById("upcoming").style.visibility = "hidden";
    document.getElementById("upcoming").style.opacity = 0;
    document.getElementById("overall").style.visibility = "hidden";
    document.getElementById("overall").style.opacity = 0;
    document.getElementById("customtasklist").style.visibility = "visible";
    document.getElementById("customtasklist").style.opacity = 1;
    document.getElementById("choose").style.visibility = "hidden";

}



async function showdynamic(t) {

    
    var tt = t;
    document.getElementById("listheading").innerHTML = t;
    console.log('dynamiclistshow.php?category='+tt);
    const response=await fetch('dynamiclistshow.php?category='+tt);
    console.log(response.status);
    if (response.ok) { // if HTTP-status is 200-299
        // get the response body (the method explained below)
        let json = await response.text();
        console.log(json);
        var html=document.getElementById('cts');
        html.innerHTML=json;
      } 
    else 
    {
        alert("HTTP-Error: " + response.status);
    }
}   



function listinsert_ajax() {
    
    var listname = $('#tasklist__input').val();
    var txtVal = $('#tasklist__input').val();
    var listNode = document.getElementById('task-list-add');
    var liN = document.createElement("LI");
    var txtNode = document.createTextNode(txtVal);
    liN.id = txtVal;
    liN.className = 'oneitem';
    liN.setAttribute("onclick","customtasklistvis(" + txtVal + ")");

    liN.appendChild(txtNode);
    listNode.appendChild(liN);

    

    $.ajax({
        type: 'POST',
        url : "insert_list.php",
        data : {'listname': listname},
        proessData:false,
        // success : function(response) {
            
        // }
    });

}

function myday_ajax() {

    var taskname = $('#tasks__inputid_myday').val();
    var txtVal = $('#tasks__inputid_myday').val(),
    listNode = document.getElementById('myday_taskl'),
    liN = document.createElement("LI"),
    txtNode = document.createTextNode(txtVal);
    liN.id = txtVal;
    liN.className = 'oneitem';
    liN.setAttribute("onclick","showinfo_t(" + txtVal + ")");

    console.log(txtVal);
    liN.appendChild(txtNode);
    listNode.appendChild(liN);
    $.ajax({
        type: 'POST',
        url : "insert_myday.php",
        data : {'task_name': taskname},
        // success : function(response) {
            
        // }
    });
    
    

}
function important_ajax() {

    var taskname = $('#tasks__inputid_important').val();
    var txtVal = $('#tasks__inputid_important').val(),
    listNode = document.getElementById('important_taskl'),
    liN = document.createElement("LI"),
    txtNode = document.createTextNode(txtVal);
    liN.id = txtVal;
    liN.className = 'oneitem';
    liN.setAttribute("onclick","showinfo_t(" + txtVal + ")");

    liN.appendChild(txtNode);
    listNode.appendChild(liN);
    $.ajax({
        type: 'POST',
        url : "insert_important.php",
        data : {'task_name': taskname},
        // success : function(response) {
            
        // }
    });

    
}

function listh_ajax() {
    var taskname = $('#tasks__inputid_list').val();
    var txtVal = $('#tasks__inputid_list').val(),
    listNode = document.getElementById('cts'),
    liN = document.createElement("LI"),
    txtNode = document.createTextNode(txtVal);
    liN.id = txtVal;
    liN.className = 'oneitem';
    liN.setAttribute("onclick","showinfo_t(" + txtVal + ")");
    
    liN.appendChild(txtNode);
    listNode.appendChild(liN);
    $.ajax({
        type: 'POST',
        url : "insert_dynamic.php",
        data : {'task_name': taskname , 'currentlist' : usingnow},
        
        // success : function(response) {
            
        // }
    });
}

function upcoming_ajax() {

    var taskname = $('#tasks__inputid_upcoming').val();
    var txtVal = $('#tasks__inputid_upcoming').val(),
    listNode = document.getElementById('upcoming_taskl'),
    liN = document.createElement("LI"),
    txtNode = document.createTextNode(txtVal);
    liN.id = txtVal;
    liN.className = 'oneitem';
    liN.setAttribute("onclick","showinfo_t(" + txtVal + ")");

    liN.appendChild(txtNode);
    listNode.appendChild(liN);
    $.ajax({
        type: 'POST',
        url : "insert_upcoming.php",
        data : {'task_name': taskname},
        // success : function(response) {
            
        // }
    });
    
}


function update_note() {
    // alert(inuse);
    var notte = $('#note_u').val();
    $.ajax({
        type: 'POST',
        url : "updatenote.php",
        data : {'task_name': inuse , 'no' : notte},
        
        success : function() {
            // alert();
            document.getElementById("nott").innerHTML = notte;
        }
        
    });

    // var taskname = $('#tasks__inputid_list').val();
    // var txtVal = $('#tasks__inputid_list').val(),
    // listNode = document.getElementById('cts'),
    // liN = document.createElement("LI"),
    // txtNode = document.createTextNode(txtVal);
    // liN.id = txtVal;
    // liN.className = 'oneitem';
    // liN.setAttribute("onclick","showinfo_t(" + txtVal + ")");
    
    // liN.appendChild(txtNode);
    // listNode.appendChild(liN);
    // $.ajax({
    //     type: 'POST',
    //     url : "insert_dynamic.php",
    //     data : {'task_name': taskname , 'currentlist' : usingnow},
        
    //     // success : function(response) {
            
    //     // }
    // });
}

function deltask() {

    var tsk = inuse;

    $.ajax({
        
        type: 'GET',
        url : "delete_task.php",
        data : {'task_name': tsk},
        proessData:false,
        dataType: 'json', 
        // success: function(data)          //on recieve of reply
        // {
        //     console.log(data.note);
            
        // }
        
        
     });

     window.location="index.php";


}

// function logout() {
//     $.ajax({
//         type: 'GET',
//         url : "logout.php",
//         data : {},
//         proessData:false,
//         dataType: 'json', 
//     })

//     window.location="signin.html";


// }