const canvas = document.getElementById('canvas');
const ctx = canvas.getContext('2d');
const images = [];
const texts = [];
const elements = [];
const stickerSelect = document.getElementById('sticker-input');
const previewSticker = document.getElementById('preview-sticker');
let dragIndex = -1;
let dragOffsetX = 0;
let dragOffsetY = 0;

function myImage(type, img, x, y, scalefactor) {
    this.type = type;
    this.img = img;
    this.x = x;
    this.y = y;
    this.scalefactor = scalefactor;
}

function myText(type, text, x, y, font, color) {
    this.type = type;
    this.text = text;
    this.x = x;
    this.y = y;
    this.font = font;
    this.color = color;
}

document.getElementById('hex').addEventListener('change', function(e) {
    render();
});

document.getElementById('image-input').addEventListener('change', function(e) {
    const files = e.target.files;
    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        console.log(file);
        const reader = new FileReader();
        reader.onload = function() {
            const img = new Image();
            img.onload = function() {
                const x = Math.random() * (canvas.width - img.width * 0.5);
                const y = Math.random() * (canvas.height - img.height * 0.5);
                const scalefactor = document.getElementById('image-size-input').value;
                images.push(new myImage("img", img, x, y, scalefactor));
                elements.push(new myImage("img", img, x, y, scalefactor));
                render();
            };
            img.src = reader.result;
        };
        reader.readAsDataURL(file);
    }
});

document.getElementById('text-input').addEventListener('keydown', function(e) {
    if (e.key === 'Enter') {
        const text = e.target.value;
        const x = 50; // Initial x position
        const y = 50 + texts.length * 50; // Initial y position (50 pixels below the previous text)
        const font = document.getElementById('font-size-input').value; // Font style
        const color = document.getElementById('font-color-input').value; // Font color
        // Add the text object to the array with its initial position and style
        texts.push(new myText("text", text, x, y, font, color));
        elements.push(new myText("text", text, x, y, font, color));
        e.target.value = ''; // Clear the input field
        // Render all images and texts on the canvas
        render();
    }
});

document.getElementById('add-sticker-button').addEventListener('click', function(e) {
    const stickerid = document.getElementById('sticker-input').value;
    var img = document.getElementById(stickerid);
    const x = Math.random() * (canvas.width - img.width * 0.5);
    const y = Math.random() * (canvas.height - img.height * 0.5);
    const scalefactor = document.getElementById('sticker-size-input').value;
    images.push(new myImage("img", img, x, y, scalefactor));
    elements.push(new myImage("img", img, x, y, scalefactor));
    render();
});

function render() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.fillStyle = document.getElementById("hex").value;
    ctx.fillRect(0, 0, canvas.width, canvas.height);
    images.forEach(image => {
        const scaleFactor = image.scalefactor;
        const scaledWidth = image.img.width * scaleFactor;
        const scaledHeight = image.img.height * scaleFactor;
        ctx.drawImage(image.img, image.x, image.y, scaledWidth, scaledHeight);
    });
    texts.forEach(text => {
        ctx.font = text.font;
        ctx.fillStyle = text.color;
        ctx.fillText(text.text, text.x, text.y);
    });
}

canvas.addEventListener('mousedown', function(e) {
    let found = false;
    // check if the click is on a text object
    texts.forEach((text, index) => {
        const textWidth = ctx.measureText(text.text).width;
        const textHeight = parseInt(text.font);
        if (e.offsetX >= text.x && e.offsetX < text.x + textWidth &&
            e.offsetY >= text.y - textHeight && e.offsetY < text.y) {
            dragIndex = index + images.length; // add the length of the images array to get the correct index
            dragOffsetX = e.offsetX - text.x;
            dragOffsetY = e.offsetY - text.y;
            found = true;
        }
    });
    // if the click is not on a text object, check if it's on an image object
    if (!found) {
        images.forEach((image, index) => {
            if (e.offsetX >= image.x && e.offsetX < image.x + image.img.width &&
                e.offsetY >= image.y && e.offsetY < image.y + image.img.height) {
                dragIndex = index;
                dragOffsetX = e.offsetX - image.x;
                dragOffsetY = e.offsetY - image.y;
            }
        });
    }
});

canvas.addEventListener('mousemove', function(e) {
    if (dragIndex >= 0) {
        if (dragIndex < images.length) {
            images[dragIndex].x = e.offsetX - dragOffsetX;
            images[dragIndex].y = e.offsetY - dragOffsetY;
        } else {
            texts[dragIndex - images.length].x = e.offsetX - dragOffsetX;
            texts[dragIndex - images.length].y = e.offsetY - dragOffsetY;
        }
        render();
    }
});

canvas.addEventListener('mouseup', function() {
    dragIndex = -1;
});

// Update the preview image when an option is selected
stickerSelect.addEventListener('change', function() {
    const selectedOption = stickerSelect.options[stickerSelect.selectedIndex];
    const imageSrc = selectedOption.getAttribute('data-image');
    previewSticker.src = imageSrc;
});

document.getElementById('delete-button').addEventListener('click', function() {
    if (elements.length > 0) {
        const poppedElement = elements.pop();
        var elementType = poppedElement.type;
        if (elementType === 'img') {
            images.pop();
        } else if (elementType === 'text') {
            texts.pop();
        }
        render();
    }
});

// Add event listener to handle image export
document.getElementById('save').addEventListener('click', function() {
    const dataURL = canvas.toDataURL('image/png');
    document.getElementById("scrap-blob").value = dataURL;
    console.log(document.getElementById("scrap-blob").value);
});