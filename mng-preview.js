document.getElementById('pasteArea').addEventListener('paste', function (event) {
  const items = event.clipboardData.items;
  for (let i = 0; i < items.length; i++) {
    if (items[i].kind === 'file' && items[i].type.startsWith('image/')) {
      const file = items[i].getAsFile();
      const reader = new FileReader();
      reader.onload = function (e) {
        addPreview(e.target.result, file.type);
      };
      reader.readAsDataURL(file);
    } else if (items[i].kind === 'string' && items[i].type === 'text/plain') {
      items[i].getAsString(function (str) {
        addPreview(str, 'text/plain');
      });
    }
  }
});

function addPreview(data, type) {
  const previews = document.getElementById('previews');

  const wrapper = document.createElement('div');
  wrapper.className = 'preview-item mb-4 p-2 border border-gray-300 rounded-lg relative';

  const hiddenInputData = document.createElement('input');
  hiddenInputData.type = 'hidden';
  hiddenInputData.name = 'datas[]';
  hiddenInputData.value = data;
  const hiddenInputType = document.createElement('input');
  hiddenInputType.type = 'hidden';
  hiddenInputType.name = 'types[]';
  hiddenInputType.value = type;
  

  if (type.startsWith('image/')) {
    const img = document.createElement('img');
    img.src = data;
    img.className = 'max-w-full h-auto mb-2';
    wrapper.appendChild(img);
  } else {
    const text = document.createElement('p');
    text.textContent = data;
    wrapper.appendChild(text);
  }

  const deleteDivBtn = document.createElement('div');

  // SVG要素を作成
  const svg = document.createElementNS("http://www.w3.org/2000/svg", "svg");
  svg.setAttribute("xmlns", "http://www.w3.org/2000/svg");
  svg.setAttribute("width", "18");
  svg.setAttribute("height", "18");
  svg.setAttribute("viewBox", "0 0 24 24");
  svg.setAttribute("fill", "none");
  svg.setAttribute("stroke", "currentColor");
  svg.setAttribute("stroke-width", "2");
  svg.setAttribute("stroke-linecap", "round");
  svg.setAttribute("stroke-linejoin", "round");
  svg.setAttribute("class", "lucide lucide-trash-2");

  // path要素1を作成
  const path1 = document.createElementNS("http://www.w3.org/2000/svg", "path");
  path1.setAttribute("d", "M3 6h18");

  // path要素2を作成
  const path2 = document.createElementNS("http://www.w3.org/2000/svg", "path");
  path2.setAttribute("d", "M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6");

  // path要素3を作成
  const path3 = document.createElementNS("http://www.w3.org/2000/svg", "path");
  path3.setAttribute("d", "M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2");

  // line要素1を作成
  const line1 = document.createElementNS("http://www.w3.org/2000/svg", "line");
  line1.setAttribute("x1", "10");
  line1.setAttribute("x2", "10");
  line1.setAttribute("y1", "11");
  line1.setAttribute("y2", "17");

  // line要素2を作成
  const line2 = document.createElementNS("http://www.w3.org/2000/svg", "line");
  line2.setAttribute("x1", "14");
  line2.setAttribute("x2", "14");
  line2.setAttribute("y1", "11");
  line2.setAttribute("y2", "17");

  // SVGにpathとline要素を追加
  svg.appendChild(path1);
  svg.appendChild(path2);
  svg.appendChild(path3);
  svg.appendChild(line1);
  svg.appendChild(line2);

  deleteDivBtn.appendChild(svg);

  deleteDivBtn.addEventListener('click', function () {
    previews.removeChild(wrapper);
  });
  deleteDivBtn.className = 'px-1 py-1';

  wrapper.appendChild(hiddenInputData);
  wrapper.appendChild(hiddenInputType);
  wrapper.appendChild(deleteDivBtn);
  previews.appendChild(wrapper);
}