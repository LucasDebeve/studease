(self["webpackChunk"] = self["webpackChunk"] || []).push([["insertions"],{

/***/ "./assets/insertion.js":
/*!*****************************!*\
  !*** ./assets/insertion.js ***!
  \*****************************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

__webpack_require__(/*! core-js/modules/es.array.concat.js */ "./node_modules/core-js/modules/es.array.concat.js");
__webpack_require__(/*! core-js/modules/es.parse-int.js */ "./node_modules/core-js/modules/es.parse-int.js");
__webpack_require__(/*! core-js/modules/es.array.from.js */ "./node_modules/core-js/modules/es.array.from.js");
__webpack_require__(/*! core-js/modules/es.string.iterator.js */ "./node_modules/core-js/modules/es.string.iterator.js");
__webpack_require__(/*! core-js/modules/es.array.map.js */ "./node_modules/core-js/modules/es.array.map.js");
__webpack_require__(/*! core-js/modules/es.error.to-string.js */ "./node_modules/core-js/modules/es.error.to-string.js");
__webpack_require__(/*! core-js/modules/es.date.to-string.js */ "./node_modules/core-js/modules/es.date.to-string.js");
__webpack_require__(/*! core-js/modules/es.object.to-string.js */ "./node_modules/core-js/modules/es.object.to-string.js");
__webpack_require__(/*! core-js/modules/es.regexp.to-string.js */ "./node_modules/core-js/modules/es.regexp.to-string.js");
__webpack_require__(/*! core-js/modules/es.array.for-each.js */ "./node_modules/core-js/modules/es.array.for-each.js");
__webpack_require__(/*! core-js/modules/web.dom-collections.for-each.js */ "./node_modules/core-js/modules/web.dom-collections.for-each.js");
__webpack_require__(/*! core-js/modules/es.array.includes.js */ "./node_modules/core-js/modules/es.array.includes.js");
__webpack_require__(/*! core-js/modules/es.string.includes.js */ "./node_modules/core-js/modules/es.string.includes.js");
var insertionsConst = document.querySelector("ul.insertions");
var save = sauvegarderEtat(insertionsConst);
setAddFilterInsertionCallback(insertionsConst);
function createHtmlInsertion(insertion) {
  var liElt = document.createElement("li");
  liElt.className = "insertion";
  liElt.innerHTML = "<a href=\"/insertions-professionnelles/".concat(insertion.id, "\" class=\"\">\n                            <div class=\"insertion__id\" hidden=\"hidden\">").concat(insertion.id, "</div>\n                            <h3 class=\"insertion__titre\">").concat(insertion.titre, "</h3>\n                            <div class=\"\">Dur\xE9e : \n                                <div class=\"insertion__duree\">").concat(insertion.duree, "</div>, D\xE9but: \n                                <div class=\"insertion__dateDeb\">").concat(insertion.dateDeb, "</div>\n                            </div>\n                        </a>");
  return liElt;
}
function extractInsertion(insertionElt) {
  return {
    id: insertionElt.firstElementChild.children[0].lastChild.nodeValue,
    titre: insertionElt.firstElementChild.children[1].lastChild.nodeValue,
    contrat: insertionElt.firstElementChild.children[3].lastChild.nodeValue,
    duree: parseInt(insertionElt.firstElementChild.children[2].children[0].lastChild.nodeValue, 10),
    dateDeb: insertionElt.firstElementChild.children[2].children[1].lastChild.nodeValue,
    query: insertionElt
  };
}
function extractInsertions(insertionsElt) {
  var insertions = Array.from(insertionsElt.children);
  return insertions.map(function (insertion) {
    return extractInsertion(insertion);
  });
}
function sauvegarderEtat(element) {
  return {
    parent: element.parentNode,
    nextSibling: element.nextSibling,
    contenu: element.innerHTML
    // Ajoutez d'autres propriétés à sauvegarder au besoin
  };
}
function setAddFilterInsertionCallback(insertions) {
  var insertionsList = extractInsertions(insertions);
  var intituleInsertion = document.querySelector("input.input.intitule_insertion");
  var typeContrat = document.querySelector("select.input.type_contrat_insertion");
  var dateDebPre = document.querySelector("input.input.date_debut_avant_insertion");
  var dateDebPost = document.querySelector("input.input.date_debut_apres_insertion");
  intituleInsertion.addEventListener("keyup", function () {
    var intitule = document.getElementById("intitule").value.toString().toUpperCase();
    insertionsList.forEach(function (insertion) {
      if (!insertion['titre'].toUpperCase().includes(intitule)) {
        if (insertions.contains(insertion['query'])) {
          insertions.removeChild(insertion['query']);
        }
      } else {
        if (!insertions.contains(insertion['query'])) {
          insertions.appendChild(insertion['query']);
        }
      }
    });
  });
  typeContrat.addEventListener("change", function () {
    var contrat = typeContrat.options[typeContrat.selectedIndex].value;
    insertionsList.forEach(function (insertion) {
      if (contrat === "") {
        if (!insertions.contains(insertion['query'])) {
          insertions.appendChild(insertion['query']);
        }
      } else if (contrat === "stage") {
        if (!insertion['contrat'].toUpperCase().includes("1")) {
          if (insertions.contains(insertion['query'])) {
            insertions.removeChild(insertion['query']);
          }
        } else {
          if (!insertions.contains(insertion['query'])) {
            insertions.appendChild(insertion['query']);
          }
        }
      } else {
        if (!insertion['contrat'].toUpperCase().includes("2")) {
          if (insertions.contains(insertion['query'])) {
            insertions.removeChild(insertion['query']);
          }
        } else {
          if (!insertions.contains(insertion['query'])) {
            insertions.appendChild(insertion['query']);
          }
        }
      }
    });
  });
  dateDebPre.addEventListener("change", function () {
    var dateDebBef = document.getElementById("date_debut_avant");
    var dateDebAft = document.getElementById("date_debut_apres");
    console.log(dateDebBef);
    console.log(dateDebAft);
  });
}

/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["vendors-node_modules_core-js_modules_es_array_concat_js-node_modules_core-js_modules_es_array-efc59e"], () => (__webpack_exec__("./assets/insertion.js")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiaW5zZXJ0aW9ucy5qcyIsIm1hcHBpbmdzIjoiOzs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7QUFBQSxJQUFNQSxlQUFlLEdBQUNDLFFBQVEsQ0FBQ0MsYUFBYSxDQUFDLGVBQWUsQ0FBQztBQUM3RCxJQUFNQyxJQUFJLEdBQUNDLGVBQWUsQ0FBQ0osZUFBZSxDQUFDO0FBQzNDSyw2QkFBNkIsQ0FBQ0wsZUFBZSxDQUFDO0FBQzlDLFNBQVNNLG1CQUFtQkEsQ0FBQ0MsU0FBUyxFQUFFO0VBQ3BDLElBQUlDLEtBQUssR0FBR1AsUUFBUSxDQUFDUSxhQUFhLENBQUMsSUFBSSxDQUFDO0VBQ3hDRCxLQUFLLENBQUNFLFNBQVMsR0FBRyxXQUFXO0VBQzdCRixLQUFLLENBQUNHLFNBQVMsR0FBRyx5Q0FBeUMsQ0FBQ0MsTUFBTSxDQUFDTCxTQUFTLENBQUNNLEVBQUUsRUFBRSw2RkFBNkYsQ0FBQyxDQUFDRCxNQUFNLENBQUNMLFNBQVMsQ0FBQ00sRUFBRSxFQUFFLHFFQUFxRSxDQUFDLENBQUNELE1BQU0sQ0FBQ0wsU0FBUyxDQUFDTyxLQUFLLEVBQUUsa0lBQWtJLENBQUMsQ0FBQ0YsTUFBTSxDQUFDTCxTQUFTLENBQUNRLEtBQUssRUFBRSx3RkFBd0YsQ0FBQyxDQUFDSCxNQUFNLENBQUNMLFNBQVMsQ0FBQ1MsT0FBTyxFQUFFLDBFQUEwRSxDQUFDO0VBQy9uQixPQUFPUixLQUFLO0FBQ2hCO0FBQ0EsU0FBU1MsZ0JBQWdCQSxDQUFDQyxZQUFZLEVBQUU7RUFDcEMsT0FBTztJQUNITCxFQUFFLEVBQUVLLFlBQVksQ0FBQ0MsaUJBQWlCLENBQUNDLFFBQVEsQ0FBQyxDQUFDLENBQUMsQ0FBQ0MsU0FBUyxDQUFDQyxTQUFTO0lBQ2xFUixLQUFLLEVBQUVJLFlBQVksQ0FBQ0MsaUJBQWlCLENBQUNDLFFBQVEsQ0FBQyxDQUFDLENBQUMsQ0FBQ0MsU0FBUyxDQUFDQyxTQUFTO0lBQ3JFQyxPQUFPLEVBQUVMLFlBQVksQ0FBQ0MsaUJBQWlCLENBQUNDLFFBQVEsQ0FBQyxDQUFDLENBQUMsQ0FBQ0MsU0FBUyxDQUFDQyxTQUFTO0lBQ3ZFUCxLQUFLLEVBQUVTLFFBQVEsQ0FBQ04sWUFBWSxDQUFDQyxpQkFBaUIsQ0FBQ0MsUUFBUSxDQUFDLENBQUMsQ0FBQyxDQUFDQSxRQUFRLENBQUMsQ0FBQyxDQUFDLENBQUNDLFNBQVMsQ0FBQ0MsU0FBUyxFQUFFLEVBQUUsQ0FBQztJQUMvRk4sT0FBTyxFQUFFRSxZQUFZLENBQUNDLGlCQUFpQixDQUFDQyxRQUFRLENBQUMsQ0FBQyxDQUFDLENBQUNBLFFBQVEsQ0FBQyxDQUFDLENBQUMsQ0FBQ0MsU0FBUyxDQUFDQyxTQUFTO0lBQ25GRyxLQUFLLEVBQUVQO0VBQ1gsQ0FBQztBQUNMO0FBQ0EsU0FBU1EsaUJBQWlCQSxDQUFDQyxhQUFhLEVBQUU7RUFDdEMsSUFBSUMsVUFBVSxHQUFHQyxLQUFLLENBQUNDLElBQUksQ0FBQ0gsYUFBYSxDQUFDUCxRQUFRLENBQUM7RUFDbkQsT0FBT1EsVUFBVSxDQUFDRyxHQUFHLENBQUMsVUFBQ3hCLFNBQVM7SUFBQSxPQUFJVSxnQkFBZ0IsQ0FBQ1YsU0FBUyxDQUFDO0VBQUEsRUFBQztBQUNwRTtBQUNBLFNBQVNILGVBQWVBLENBQUM0QixPQUFPLEVBQUU7RUFDOUIsT0FBTztJQUNIQyxNQUFNLEVBQUVELE9BQU8sQ0FBQ0UsVUFBVTtJQUMxQkMsV0FBVyxFQUFFSCxPQUFPLENBQUNHLFdBQVc7SUFDaENDLE9BQU8sRUFBRUosT0FBTyxDQUFDckI7SUFDakI7RUFDSixDQUFDO0FBQ0w7QUFDQSxTQUFTTiw2QkFBNkJBLENBQUN1QixVQUFVLEVBQUU7RUFDL0MsSUFBTVMsY0FBYyxHQUFHWCxpQkFBaUIsQ0FBQ0UsVUFBVSxDQUFDO0VBQ3BELElBQU1VLGlCQUFpQixHQUFHckMsUUFBUSxDQUFDQyxhQUFhLENBQUMsZ0NBQWdDLENBQUM7RUFDbEYsSUFBTXFDLFdBQVcsR0FBR3RDLFFBQVEsQ0FBQ0MsYUFBYSxDQUFDLHFDQUFxQyxDQUFDO0VBQ2pGLElBQU1zQyxVQUFVLEdBQUd2QyxRQUFRLENBQUNDLGFBQWEsQ0FBQyx3Q0FBd0MsQ0FBQztFQUNuRixJQUFNdUMsV0FBVyxHQUFHeEMsUUFBUSxDQUFDQyxhQUFhLENBQUMsd0NBQXdDLENBQUM7RUFFcEZvQyxpQkFBaUIsQ0FBQ0ksZ0JBQWdCLENBQUMsT0FBTyxFQUFFLFlBQVk7SUFDcEQsSUFBTUMsUUFBUSxHQUFHMUMsUUFBUSxDQUFDMkMsY0FBYyxDQUFDLFVBQVUsQ0FBQyxDQUFDQyxLQUFLLENBQUNDLFFBQVEsQ0FBQyxDQUFDLENBQUNDLFdBQVcsQ0FBQyxDQUFDO0lBQ25GVixjQUFjLENBQUNXLE9BQU8sQ0FBQyxVQUFVekMsU0FBUyxFQUFFO01BQ3hDLElBQUksQ0FBQ0EsU0FBUyxDQUFDLE9BQU8sQ0FBQyxDQUFDd0MsV0FBVyxDQUFDLENBQUMsQ0FBQ0UsUUFBUSxDQUFDTixRQUFRLENBQUMsRUFBRTtRQUN0RCxJQUFHZixVQUFVLENBQUNzQixRQUFRLENBQUMzQyxTQUFTLENBQUMsT0FBTyxDQUFDLENBQUMsRUFBRTtVQUN4Q3FCLFVBQVUsQ0FBQ3VCLFdBQVcsQ0FBQzVDLFNBQVMsQ0FBQyxPQUFPLENBQUMsQ0FBQztRQUM5QztNQUNKLENBQUMsTUFBTTtRQUNILElBQUksQ0FBQ3FCLFVBQVUsQ0FBQ3NCLFFBQVEsQ0FBQzNDLFNBQVMsQ0FBQyxPQUFPLENBQUMsQ0FBQyxFQUFFO1VBQzFDcUIsVUFBVSxDQUFDd0IsV0FBVyxDQUFDN0MsU0FBUyxDQUFDLE9BQU8sQ0FBQyxDQUFDO1FBQzlDO01BQ0o7SUFDSixDQUFDLENBQUM7RUFDTixDQUFDLENBQUM7RUFFRmdDLFdBQVcsQ0FBQ0csZ0JBQWdCLENBQUMsUUFBUSxFQUFFLFlBQVk7SUFDL0MsSUFBTW5CLE9BQU8sR0FBR2dCLFdBQVcsQ0FBQ2MsT0FBTyxDQUFDZCxXQUFXLENBQUNlLGFBQWEsQ0FBQyxDQUFDVCxLQUFLO0lBQ3BFUixjQUFjLENBQUNXLE9BQU8sQ0FBQyxVQUFVekMsU0FBUyxFQUFFO01BQ3hDLElBQUlnQixPQUFPLEtBQUssRUFBRSxFQUFFO1FBQ2hCLElBQUksQ0FBQ0ssVUFBVSxDQUFDc0IsUUFBUSxDQUFDM0MsU0FBUyxDQUFDLE9BQU8sQ0FBQyxDQUFDLEVBQUU7VUFDMUNxQixVQUFVLENBQUN3QixXQUFXLENBQUM3QyxTQUFTLENBQUMsT0FBTyxDQUFDLENBQUM7UUFDOUM7TUFDSixDQUFDLE1BQU0sSUFBR2dCLE9BQU8sS0FBSyxPQUFPLEVBQUU7UUFDM0IsSUFBSSxDQUFDaEIsU0FBUyxDQUFDLFNBQVMsQ0FBQyxDQUFDd0MsV0FBVyxDQUFDLENBQUMsQ0FBQ0UsUUFBUSxDQUFDLEdBQUcsQ0FBQyxFQUFFO1VBQ25ELElBQUdyQixVQUFVLENBQUNzQixRQUFRLENBQUMzQyxTQUFTLENBQUMsT0FBTyxDQUFDLENBQUMsRUFBRTtZQUN4Q3FCLFVBQVUsQ0FBQ3VCLFdBQVcsQ0FBQzVDLFNBQVMsQ0FBQyxPQUFPLENBQUMsQ0FBQztVQUM5QztRQUNKLENBQUMsTUFBTTtVQUNILElBQUksQ0FBQ3FCLFVBQVUsQ0FBQ3NCLFFBQVEsQ0FBQzNDLFNBQVMsQ0FBQyxPQUFPLENBQUMsQ0FBQyxFQUFFO1lBQzFDcUIsVUFBVSxDQUFDd0IsV0FBVyxDQUFDN0MsU0FBUyxDQUFDLE9BQU8sQ0FBQyxDQUFDO1VBQzlDO1FBQ0o7TUFDSixDQUFDLE1BQUs7UUFDRixJQUFJLENBQUNBLFNBQVMsQ0FBQyxTQUFTLENBQUMsQ0FBQ3dDLFdBQVcsQ0FBQyxDQUFDLENBQUNFLFFBQVEsQ0FBQyxHQUFHLENBQUMsRUFBRTtVQUNuRCxJQUFHckIsVUFBVSxDQUFDc0IsUUFBUSxDQUFDM0MsU0FBUyxDQUFDLE9BQU8sQ0FBQyxDQUFDLEVBQUU7WUFDeENxQixVQUFVLENBQUN1QixXQUFXLENBQUM1QyxTQUFTLENBQUMsT0FBTyxDQUFDLENBQUM7VUFDOUM7UUFDSixDQUFDLE1BQU07VUFDSCxJQUFJLENBQUNxQixVQUFVLENBQUNzQixRQUFRLENBQUMzQyxTQUFTLENBQUMsT0FBTyxDQUFDLENBQUMsRUFBRTtZQUMxQ3FCLFVBQVUsQ0FBQ3dCLFdBQVcsQ0FBQzdDLFNBQVMsQ0FBQyxPQUFPLENBQUMsQ0FBQztVQUM5QztRQUNKO01BQ0o7SUFDSixDQUFDLENBQUM7RUFDTixDQUFDLENBQUM7RUFFRmlDLFVBQVUsQ0FBQ0UsZ0JBQWdCLENBQUMsUUFBUSxFQUFDLFlBQUk7SUFDckMsSUFBTWEsVUFBVSxHQUFFdEQsUUFBUSxDQUFDMkMsY0FBYyxDQUFDLGtCQUFrQixDQUFDO0lBQzdELElBQU1ZLFVBQVUsR0FBR3ZELFFBQVEsQ0FBQzJDLGNBQWMsQ0FBQyxrQkFBa0IsQ0FBQztJQUM5RGEsT0FBTyxDQUFDQyxHQUFHLENBQUNILFVBQVUsQ0FBQztJQUN2QkUsT0FBTyxDQUFDQyxHQUFHLENBQUNGLFVBQVUsQ0FBQztFQUMzQixDQUFDLENBQUM7QUFDTiIsInNvdXJjZXMiOlsid2VicGFjazovLy8uL2Fzc2V0cy9pbnNlcnRpb24uanMiXSwic291cmNlc0NvbnRlbnQiOlsiY29uc3QgaW5zZXJ0aW9uc0NvbnN0PWRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoXCJ1bC5pbnNlcnRpb25zXCIpO1xyXG5jb25zdCBzYXZlPXNhdXZlZ2FyZGVyRXRhdChpbnNlcnRpb25zQ29uc3QpO1xyXG5zZXRBZGRGaWx0ZXJJbnNlcnRpb25DYWxsYmFjayhpbnNlcnRpb25zQ29uc3QpO1xyXG5mdW5jdGlvbiBjcmVhdGVIdG1sSW5zZXJ0aW9uKGluc2VydGlvbikge1xyXG4gICAgdmFyIGxpRWx0ID0gZG9jdW1lbnQuY3JlYXRlRWxlbWVudChcImxpXCIpO1xyXG4gICAgbGlFbHQuY2xhc3NOYW1lID0gXCJpbnNlcnRpb25cIjtcclxuICAgIGxpRWx0LmlubmVySFRNTCA9IFwiPGEgaHJlZj1cXFwiL2luc2VydGlvbnMtcHJvZmVzc2lvbm5lbGxlcy9cIi5jb25jYXQoaW5zZXJ0aW9uLmlkLCBcIlxcXCIgY2xhc3M9XFxcIlxcXCI+XFxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIDxkaXYgY2xhc3M9XFxcImluc2VydGlvbl9faWRcXFwiIGhpZGRlbj1cXFwiaGlkZGVuXFxcIj5cIikuY29uY2F0KGluc2VydGlvbi5pZCwgXCI8L2Rpdj5cXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgPGgzIGNsYXNzPVxcXCJpbnNlcnRpb25fX3RpdHJlXFxcIj5cIikuY29uY2F0KGluc2VydGlvbi50aXRyZSwgXCI8L2gzPlxcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICA8ZGl2IGNsYXNzPVxcXCJcXFwiPkR1clxceEU5ZSA6IFxcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgPGRpdiBjbGFzcz1cXFwiaW5zZXJ0aW9uX19kdXJlZVxcXCI+XCIpLmNvbmNhdChpbnNlcnRpb24uZHVyZWUsIFwiPC9kaXY+LCBEXFx4RTlidXQ6IFxcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgPGRpdiBjbGFzcz1cXFwiaW5zZXJ0aW9uX19kYXRlRGViXFxcIj5cIikuY29uY2F0KGluc2VydGlvbi5kYXRlRGViLCBcIjwvZGl2PlxcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICA8L2Rpdj5cXG4gICAgICAgICAgICAgICAgICAgICAgICA8L2E+XCIpO1xyXG4gICAgcmV0dXJuIGxpRWx0O1xyXG59XHJcbmZ1bmN0aW9uIGV4dHJhY3RJbnNlcnRpb24oaW5zZXJ0aW9uRWx0KSB7XHJcbiAgICByZXR1cm4ge1xyXG4gICAgICAgIGlkOiBpbnNlcnRpb25FbHQuZmlyc3RFbGVtZW50Q2hpbGQuY2hpbGRyZW5bMF0ubGFzdENoaWxkLm5vZGVWYWx1ZSxcclxuICAgICAgICB0aXRyZTogaW5zZXJ0aW9uRWx0LmZpcnN0RWxlbWVudENoaWxkLmNoaWxkcmVuWzFdLmxhc3RDaGlsZC5ub2RlVmFsdWUsXHJcbiAgICAgICAgY29udHJhdDogaW5zZXJ0aW9uRWx0LmZpcnN0RWxlbWVudENoaWxkLmNoaWxkcmVuWzNdLmxhc3RDaGlsZC5ub2RlVmFsdWUsXHJcbiAgICAgICAgZHVyZWU6IHBhcnNlSW50KGluc2VydGlvbkVsdC5maXJzdEVsZW1lbnRDaGlsZC5jaGlsZHJlblsyXS5jaGlsZHJlblswXS5sYXN0Q2hpbGQubm9kZVZhbHVlLCAxMCksXHJcbiAgICAgICAgZGF0ZURlYjogaW5zZXJ0aW9uRWx0LmZpcnN0RWxlbWVudENoaWxkLmNoaWxkcmVuWzJdLmNoaWxkcmVuWzFdLmxhc3RDaGlsZC5ub2RlVmFsdWUsXHJcbiAgICAgICAgcXVlcnk6IGluc2VydGlvbkVsdFxyXG4gICAgfTtcclxufVxyXG5mdW5jdGlvbiBleHRyYWN0SW5zZXJ0aW9ucyhpbnNlcnRpb25zRWx0KSB7XHJcbiAgICB2YXIgaW5zZXJ0aW9ucyA9IEFycmF5LmZyb20oaW5zZXJ0aW9uc0VsdC5jaGlsZHJlbik7XHJcbiAgICByZXR1cm4gaW5zZXJ0aW9ucy5tYXAoKGluc2VydGlvbikgPT5leHRyYWN0SW5zZXJ0aW9uKGluc2VydGlvbikpO1xyXG59XHJcbmZ1bmN0aW9uIHNhdXZlZ2FyZGVyRXRhdChlbGVtZW50KSB7XHJcbiAgICByZXR1cm4ge1xyXG4gICAgICAgIHBhcmVudDogZWxlbWVudC5wYXJlbnROb2RlLFxyXG4gICAgICAgIG5leHRTaWJsaW5nOiBlbGVtZW50Lm5leHRTaWJsaW5nLFxyXG4gICAgICAgIGNvbnRlbnU6IGVsZW1lbnQuaW5uZXJIVE1MLFxyXG4gICAgICAgIC8vIEFqb3V0ZXogZCdhdXRyZXMgcHJvcHJpw6l0w6lzIMOgIHNhdXZlZ2FyZGVyIGF1IGJlc29pblxyXG4gICAgfTtcclxufVxyXG5mdW5jdGlvbiBzZXRBZGRGaWx0ZXJJbnNlcnRpb25DYWxsYmFjayhpbnNlcnRpb25zKSB7XHJcbiAgICBjb25zdCBpbnNlcnRpb25zTGlzdCA9IGV4dHJhY3RJbnNlcnRpb25zKGluc2VydGlvbnMpO1xyXG4gICAgY29uc3QgaW50aXR1bGVJbnNlcnRpb24gPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKFwiaW5wdXQuaW5wdXQuaW50aXR1bGVfaW5zZXJ0aW9uXCIpO1xyXG4gICAgY29uc3QgdHlwZUNvbnRyYXQgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKFwic2VsZWN0LmlucHV0LnR5cGVfY29udHJhdF9pbnNlcnRpb25cIik7XHJcbiAgICBjb25zdCBkYXRlRGViUHJlID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcihcImlucHV0LmlucHV0LmRhdGVfZGVidXRfYXZhbnRfaW5zZXJ0aW9uXCIpO1xyXG4gICAgY29uc3QgZGF0ZURlYlBvc3QgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKFwiaW5wdXQuaW5wdXQuZGF0ZV9kZWJ1dF9hcHJlc19pbnNlcnRpb25cIilcclxuXHJcbiAgICBpbnRpdHVsZUluc2VydGlvbi5hZGRFdmVudExpc3RlbmVyKFwia2V5dXBcIiwgZnVuY3Rpb24gKCkge1xyXG4gICAgICAgIGNvbnN0IGludGl0dWxlID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoXCJpbnRpdHVsZVwiKS52YWx1ZS50b1N0cmluZygpLnRvVXBwZXJDYXNlKCk7XHJcbiAgICAgICAgaW5zZXJ0aW9uc0xpc3QuZm9yRWFjaChmdW5jdGlvbiAoaW5zZXJ0aW9uKSB7XHJcbiAgICAgICAgICAgIGlmICghaW5zZXJ0aW9uWyd0aXRyZSddLnRvVXBwZXJDYXNlKCkuaW5jbHVkZXMoaW50aXR1bGUpKSB7XHJcbiAgICAgICAgICAgICAgICBpZihpbnNlcnRpb25zLmNvbnRhaW5zKGluc2VydGlvblsncXVlcnknXSkpIHtcclxuICAgICAgICAgICAgICAgICAgICBpbnNlcnRpb25zLnJlbW92ZUNoaWxkKGluc2VydGlvblsncXVlcnknXSk7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH0gZWxzZSB7XHJcbiAgICAgICAgICAgICAgICBpZiAoIWluc2VydGlvbnMuY29udGFpbnMoaW5zZXJ0aW9uWydxdWVyeSddKSkge1xyXG4gICAgICAgICAgICAgICAgICAgIGluc2VydGlvbnMuYXBwZW5kQ2hpbGQoaW5zZXJ0aW9uWydxdWVyeSddKTtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH0pO1xyXG4gICAgfSk7XHJcblxyXG4gICAgdHlwZUNvbnRyYXQuYWRkRXZlbnRMaXN0ZW5lcihcImNoYW5nZVwiLCBmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgY29uc3QgY29udHJhdCA9IHR5cGVDb250cmF0Lm9wdGlvbnNbdHlwZUNvbnRyYXQuc2VsZWN0ZWRJbmRleF0udmFsdWU7XHJcbiAgICAgICAgaW5zZXJ0aW9uc0xpc3QuZm9yRWFjaChmdW5jdGlvbiAoaW5zZXJ0aW9uKSB7XHJcbiAgICAgICAgICAgIGlmIChjb250cmF0ID09PSBcIlwiKSB7XHJcbiAgICAgICAgICAgICAgICBpZiAoIWluc2VydGlvbnMuY29udGFpbnMoaW5zZXJ0aW9uWydxdWVyeSddKSkge1xyXG4gICAgICAgICAgICAgICAgICAgIGluc2VydGlvbnMuYXBwZW5kQ2hpbGQoaW5zZXJ0aW9uWydxdWVyeSddKTtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfSBlbHNlIGlmKGNvbnRyYXQgPT09IFwic3RhZ2VcIikge1xyXG4gICAgICAgICAgICAgICAgaWYgKCFpbnNlcnRpb25bJ2NvbnRyYXQnXS50b1VwcGVyQ2FzZSgpLmluY2x1ZGVzKFwiMVwiKSkge1xyXG4gICAgICAgICAgICAgICAgICAgIGlmKGluc2VydGlvbnMuY29udGFpbnMoaW5zZXJ0aW9uWydxdWVyeSddKSkge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBpbnNlcnRpb25zLnJlbW92ZUNoaWxkKGluc2VydGlvblsncXVlcnknXSk7XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfSBlbHNlIHtcclxuICAgICAgICAgICAgICAgICAgICBpZiAoIWluc2VydGlvbnMuY29udGFpbnMoaW5zZXJ0aW9uWydxdWVyeSddKSkge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBpbnNlcnRpb25zLmFwcGVuZENoaWxkKGluc2VydGlvblsncXVlcnknXSk7XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9IGVsc2V7XHJcbiAgICAgICAgICAgICAgICBpZiAoIWluc2VydGlvblsnY29udHJhdCddLnRvVXBwZXJDYXNlKCkuaW5jbHVkZXMoXCIyXCIpKSB7XHJcbiAgICAgICAgICAgICAgICAgICAgaWYoaW5zZXJ0aW9ucy5jb250YWlucyhpbnNlcnRpb25bJ3F1ZXJ5J10pKSB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGluc2VydGlvbnMucmVtb3ZlQ2hpbGQoaW5zZXJ0aW9uWydxdWVyeSddKTtcclxuICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICB9IGVsc2Uge1xyXG4gICAgICAgICAgICAgICAgICAgIGlmICghaW5zZXJ0aW9ucy5jb250YWlucyhpbnNlcnRpb25bJ3F1ZXJ5J10pKSB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGluc2VydGlvbnMuYXBwZW5kQ2hpbGQoaW5zZXJ0aW9uWydxdWVyeSddKTtcclxuICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9KTtcclxuICAgIH0pO1xyXG5cclxuICAgIGRhdGVEZWJQcmUuYWRkRXZlbnRMaXN0ZW5lcihcImNoYW5nZVwiLCgpPT57XHJcbiAgICAgICAgY29uc3QgZGF0ZURlYkJlZj0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoXCJkYXRlX2RlYnV0X2F2YW50XCIpO1xyXG4gICAgICAgIGNvbnN0IGRhdGVEZWJBZnQgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChcImRhdGVfZGVidXRfYXByZXNcIik7XHJcbiAgICAgICAgY29uc29sZS5sb2coZGF0ZURlYkJlZik7XHJcbiAgICAgICAgY29uc29sZS5sb2coZGF0ZURlYkFmdCk7XHJcbiAgICB9KTtcclxufSJdLCJuYW1lcyI6WyJpbnNlcnRpb25zQ29uc3QiLCJkb2N1bWVudCIsInF1ZXJ5U2VsZWN0b3IiLCJzYXZlIiwic2F1dmVnYXJkZXJFdGF0Iiwic2V0QWRkRmlsdGVySW5zZXJ0aW9uQ2FsbGJhY2siLCJjcmVhdGVIdG1sSW5zZXJ0aW9uIiwiaW5zZXJ0aW9uIiwibGlFbHQiLCJjcmVhdGVFbGVtZW50IiwiY2xhc3NOYW1lIiwiaW5uZXJIVE1MIiwiY29uY2F0IiwiaWQiLCJ0aXRyZSIsImR1cmVlIiwiZGF0ZURlYiIsImV4dHJhY3RJbnNlcnRpb24iLCJpbnNlcnRpb25FbHQiLCJmaXJzdEVsZW1lbnRDaGlsZCIsImNoaWxkcmVuIiwibGFzdENoaWxkIiwibm9kZVZhbHVlIiwiY29udHJhdCIsInBhcnNlSW50IiwicXVlcnkiLCJleHRyYWN0SW5zZXJ0aW9ucyIsImluc2VydGlvbnNFbHQiLCJpbnNlcnRpb25zIiwiQXJyYXkiLCJmcm9tIiwibWFwIiwiZWxlbWVudCIsInBhcmVudCIsInBhcmVudE5vZGUiLCJuZXh0U2libGluZyIsImNvbnRlbnUiLCJpbnNlcnRpb25zTGlzdCIsImludGl0dWxlSW5zZXJ0aW9uIiwidHlwZUNvbnRyYXQiLCJkYXRlRGViUHJlIiwiZGF0ZURlYlBvc3QiLCJhZGRFdmVudExpc3RlbmVyIiwiaW50aXR1bGUiLCJnZXRFbGVtZW50QnlJZCIsInZhbHVlIiwidG9TdHJpbmciLCJ0b1VwcGVyQ2FzZSIsImZvckVhY2giLCJpbmNsdWRlcyIsImNvbnRhaW5zIiwicmVtb3ZlQ2hpbGQiLCJhcHBlbmRDaGlsZCIsIm9wdGlvbnMiLCJzZWxlY3RlZEluZGV4IiwiZGF0ZURlYkJlZiIsImRhdGVEZWJBZnQiLCJjb25zb2xlIiwibG9nIl0sInNvdXJjZVJvb3QiOiIifQ==