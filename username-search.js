function search_username() {
    let searchbox = document.getElementById('search-box');
    let rect = searchbox.getBoundingClientRect();
    let input = document.getElementById('searchbar').value;
    let result = document.getElementById('search-result');
    input = input.toLowerCase();
    let x = document.getElementsByClassName('username-list');

    if (input != "") {
        let num = 0;

        for (i = 0; i < x.length; i++) {
            if (!x[i].innerHTML.toLowerCase().includes(input)) {
                x[i].style.display = "none";
            } else {
                result.style.display = "block";
                result.style.top = rect.bottom + "px";
                result.style.left = (rect.left + 50) + "px";
                x[i].style.display = "list-item";
                num = num + 1;
                document.getElementById('no-result').style.display = "none";
            }
        }

        if (num == 0) {
            document.getElementById('no-result').style.display = "block";
        }
    } else {
        result.style.display = "none";
    }
}