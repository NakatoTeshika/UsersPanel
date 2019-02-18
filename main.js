ymaps.ready(init);//как только загрузится апи и будет готов дом начнет выполняться код функции инит
function init() {
	var map = new ymap.Map('map',{
		center: [43.24, 76.91],
		zoom: 11,
		controls: ['zoomControl'],
		behaviors: []
	});
}