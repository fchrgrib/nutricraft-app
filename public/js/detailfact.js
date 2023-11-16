



const loadpage = (id) => {
    // console.log(Page);
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState === 4){
            let response = this.response;
            const jsonObject = JSON.parse(response);
            console.log(jsonObject);
            // console.log(response);
            
            const parentElement = document.getElementById("content");
            const content = jsonObject['data'][0];
            let subs = "";
            if(content.is_subscribe[0] == 'true'){
                subs = "Unsubscribe";
            }else{
                subs = "Subscribe";
            }
            const uuid = content.uuid;
            console.log(uuid);

            let html = "";
            html += `
            <h1 id="title">${content.title}</h1>
            <div class = "authorcontainer">
                <img src="../../../assets/thumbnail.png" alt="" id="image">
                <div class="authortext">
                    <h2 id="author">${content.author}</h2>
                    <h4 id="totSubs">${content.total_subscriber} Subscribers</h4>
                </div>
                <button type="button" class=${subs} id="subscribe" onclick=subscribe(${id},${uuid})>${subs}</button>
            </div>
            <div class="factcontainer">
                <img src="${content.path_photo}" alt="" id="imageContent">
                <div class="facttext">
                    <p id="bodyContent">${content.body}</p>
                </div>
            </div>
            `;
            parentElement.innerHTML = html;        
        }
    };  
    xhttp.open('GET', `../../server/controller/auth/DetailFact.php?id=${id}`, true);
    xhttp.send();

}

const subscribe = (id,uuid) => {
    console.log(uuid);
    console.log(id);
    const subscribeButton = document.getElementById('subscribe');
    if(subscribeButton.innerHTML == "Subscribe"){
        subscribeButton.innerHTML = "Unsubscribe";
        // xhttp = new XMLHttpRequest();
        // xhttp.onreadystatechange = function() {
        //     if (this.readyState === 4){
        //         let response = this.response;
        //         console.log(response);
        //     }
        // };   
        // xhttp.open('GET', `../../server/controller/auth/DetailFact.php?subscribe=1&id=${id}&uuid=${uuid}`, true);
        // xhttp.send();
    }else{
        subscribeButton.innerHTML = "Subscribe";
        // xhttp = new XMLHttpRequest();
        // xhttp.onreadystatechange = function() {
        //     if (this.readyState === 4){
        //         let response = this.response;
        //         console.log(response);
        //     }
        // };   
        // xhttp.open('GET', `../../server/controller/auth/DetailFact.php?subscribe=0&id=${id}&uuid=${uuid}`, true);
        // xhttp.send();
    }
    // loadpage(id);
}