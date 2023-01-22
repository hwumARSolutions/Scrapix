const scrapButton = document.getElementById('showScrapbook');
const scrapbook = document.getElementById('scrapbook-dialog');
const closespan = document.getElementsByClassName('close-scrapbook')[0];

scrapButton.addEventListener('click', () => {
    scrapbook.showModal();
});

closespan.onclick = function() {
    scrapbook.close();
}