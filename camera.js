let enhancer = null;

const cameraButton = document.getElementById('showCamera');
const camera = document.getElementById('cameraDialog');

cameraButton.addEventListener('click', () => {
    camera.showModal();
    (async() => {
        enhancer = await Dynamsoft.DCE.CameraEnhancer.createInstance();
        document.getElementById("enhancerUIContainer").appendChild(enhancer.getUIElement());
        await enhancer.open(true);
    })();
});

document.getElementById('capture').onclick = () => {
    if (enhancer) {
        let frame = enhancer.getFrame();
        var dataurl = frame.canvas.toDataURL('image/jpeg');
        document.getElementById("imageurl").value = dataurl;
        document.getElementById("captured-preview").src = dataurl;
    }
};