var selectedImage = document.getElementById('img-one');
var previous;

function selectNewImage($id){
	previous = selectedImage;
	selectedImage = document.getElementById($id);
	previous.className = "img";
	selectedImage.className = 'img selected-img';

	var viewSelectedImg = document.getElementById('img-selected');
	viewSelectedImg.src = selectedImage.src;
}