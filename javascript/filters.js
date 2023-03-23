var canvasHeight = window.innerHeight;
var canvasWidth = window.innerWidth;

// desktop, the width of the canvas is 0.66 * window height and on mobile it's fullscreen
if (window.innerWidth > window.innerHeight) {
    canvasWidth = Math.floor(window.innerHeight * 0.66);
}

let box = document.getElementById('canvas-left');
let canvas = document.getElementById('deepar-canvas');
canvas.width = 0.72 * box.clientWidth;
canvas.height = 0.97 * box.clientHeight;

var deepAR = new DeepAR({
    licenseKey: '486820a42692852be933d6de8d741a655493281eb10f396aa5f9e5b22154cbd5a51d2bc57d5a3e76',
    canvas: canvas,
    segmentationConfig: {
        modelPath: "lib/models/segmentation/segmentation-160x160-opt.bin"
    },
    deeparWasmPath: 'lib/wasm/deepar.wasm',
    callbacks: {
        onInitialize: function() {

        },

        onScreenshotTaken: function(photo) {
            var a = document.createElement('a');
            a.href = photo;
            a.download = 'photo.png';
            document.body.appendChild(a);
            a.click();
        }
    }
});

deepAR.callbacks.onVideoStarted = function() {
    var loaderWrapper = document.getElementById('loader-wrapper');
    loaderWrapper.style.display = 'none';
};

deepAR.downloadFaceTrackingModel('lib/models/face/models-68-extreme.bin');

var image = new Image();

function processPhoto(url) {

    // show loading animation
    var loaderWrapper = document.getElementById('loader-wrapper');
    loaderWrapper.style.display = 'block';


    // load image from url
    image.src = url;

    image.onload = function() {

        // Process image multiple times because tracking gets more accurate with more successive frames.
        // DeepAR face tracking has a temporal
        deepAR.processImage(image);
        deepAR.processImage(image);
        deepAR.processImage(image);

        // hide the loading animation
        var loaderWrapper = document.getElementById('loader-wrapper');
        loaderWrapper.style.display = 'none';
    }
}

const effects = [
    './effects/Neon_Devil_horns.deepar',
    './effects/8bitHearts.deepar',
    './effects/flower_face.deepar',
    './effects/Hope.deepar',
    './effects/Humanoid.deepar',
    './effects/look1',
    './effects/look2',
    './effects/MakeupLook.deepar',
    './effects/Vendetta_Mask.deepar',
    './effects/viking_helmet.deepar',
];

let currentEffectIdx = -1;
const btn = document.getElementById('switch-filter');
btn.addEventListener('click', () => {
    currentEffectIdx = (currentEffectIdx + 1) % effects.length;
    const effect = effects[currentEffectIdx];
    deepAR.switchEffect(0, 'slot', effect, function() {
        deepAR.processImage(image);
    });
});

document.getElementById('remove-makeup-filter').onclick = function() {
    // unload filter
    deepAR.clearEffect('slot');
    // effect unloaded, reprocess the image
    deepAR.processImage(image);
}

document.getElementById('download-photo').onclick = function() {
    deepAR.takeScreenshot();
}