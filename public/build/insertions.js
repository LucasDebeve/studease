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
  var duree = document.querySelector("input.input.duree_insertion");
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

  // ne fonctionne pas pour le moment
  dateDebPre.addEventListener("change", function () {
    var dateDebBef = new Date(document.getElementById("date_debut_avant").value);
    var dateDebAft = new Date(document.getElementById("date_debut_apres").value);
    dateDebAft.setHours(0, 0, 0, 0);
    dateDebBef.setHours(0, 0, 0, 0);
    insertionsList.forEach(function (insertion) {
      var dateDeb = new Date(insertion.dateDeb);
      dateDeb.setHours(0, 0, 0, 0);
      if (dateDebBef <= dateDeb <= dateDebAft) {
        if (!insertions.contains(insertion['query'])) {
          insertions.appendChild(insertion['query']);
        }
      } else {
        if (insertions.contains(insertion['query'])) {
          insertions.removeChild(insertion['query']);
        }
      }
    });
  });

  // ne fonctionne pas pour le moment
  dateDebPost.addEventListener("change", function () {
    var dateDebBef = new Date(document.getElementById("date_debut_avant").value);
    var dateDebAft = new Date(document.getElementById("date_debut_apres").value);
    dateDebAft.setHours(0, 0, 0, 0);
    dateDebBef.setHours(0, 0, 0, 0);
    insertionsList.forEach(function (insertion) {
      var dateDeb = new Date(insertion.dateDeb);
      dateDeb.setHours(0, 0, 0, 0);
      if (dateDebBef <= dateDeb <= dateDebAft) {
        if (!insertions.contains(insertion['query'])) {
          insertions.appendChild(insertion['query']);
        }
      } else {
        if (insertions.contains(insertion['query'])) {
          insertions.removeChild(insertion['query']);
        }
      }
    });
  });
  duree.addEventListener("keyup", function () {
    var dureeInsertion = parseInt(document.getElementById("duree").value, 10);
    insertionsList.forEach(function (insertion) {
      if (insertion.duree === dureeInsertion) {
        if (!insertions.contains(insertion['query'])) {
          insertions.appendChild(insertion['query']);
        }
      } else {
        if (insertions.contains(insertion['query'])) {
          insertions.removeChild(insertion['query']);
        }
      }
      if (!dureeInsertion) {
        if (!insertions.contains(insertion['query'])) {
          insertions.appendChild(insertion['query']);
        }
      }
    });
  });
  duree.addEventListener("change", function () {
    var dureeInsertion = parseInt(document.getElementById("duree").value, 10);
    insertionsList.forEach(function (insertion) {
      if (insertion.duree === dureeInsertion) {
        if (!insertions.contains(insertion['query'])) {
          insertions.appendChild(insertion['query']);
        }
      } else {
        if (insertions.contains(insertion['query'])) {
          insertions.removeChild(insertion['query']);
        }
      }
      if (!dureeInsertion) {
        if (!insertions.contains(insertion['query'])) {
          insertions.appendChild(insertion['query']);
        }
      }
    });
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
//# sourceMappingURL=data:application/json;charset=utf-8;base64,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R25DLFFBQVEsQ0FBQ3ZCLFFBQVEsQ0FBQzJDLGNBQWMsQ0FBQyxPQUFPLENBQUMsQ0FBQ0MsS0FBSyxFQUFDLEVBQUUsQ0FBQztJQUMxRVIsY0FBYyxDQUFDVyxPQUFPLENBQUMsVUFBVXpDLFNBQVMsRUFBRTtNQUN4QyxJQUFHQSxTQUFTLENBQUNRLEtBQUssS0FBSzRDLGNBQWMsRUFBQztRQUNsQyxJQUFJLENBQUMvQixVQUFVLENBQUNzQixRQUFRLENBQUMzQyxTQUFTLENBQUMsT0FBTyxDQUFDLENBQUMsRUFBRTtVQUMxQ3FCLFVBQVUsQ0FBQ3dCLFdBQVcsQ0FBQzdDLFNBQVMsQ0FBQyxPQUFPLENBQUMsQ0FBQztRQUM5QztNQUNKLENBQUMsTUFBSztRQUNGLElBQUlxQixVQUFVLENBQUNzQixRQUFRLENBQUMzQyxTQUFTLENBQUMsT0FBTyxDQUFDLENBQUMsRUFBRTtVQUN6Q3FCLFVBQVUsQ0FBQ3VCLFdBQVcsQ0FBQzVDLFNBQVMsQ0FBQyxPQUFPLENBQUMsQ0FBQztRQUM5QztNQUNKO01BQ0EsSUFBRyxDQUFDb0QsY0FBYyxFQUFDO1FBQ2YsSUFBSSxDQUFDL0IsVUFBVSxDQUFDc0IsUUFBUSxDQUFDM0MsU0FBUyxDQUFDLE9BQU8sQ0FBQyxDQUFDLEVBQUU7VUFDMUNxQixVQUFVLENBQUN3QixXQUFXLENBQUM3QyxTQUFTLENBQUMsT0FBTyxDQUFDLENBQUM7UUFDOUM7TUFDSjtJQUNKLENBQUMsQ0FBQztFQUNOLENBQUMsQ0FBQztBQUNOIiwic291cmNlcyI6WyJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2luc2VydGlvbi5qcyJdLCJzb3VyY2VzQ29udGVudCI6WyJjb25zdCBpbnNlcnRpb25zQ29uc3Q9ZG9jdW1lbnQucXVlcnlTZWxlY3RvcihcInVsLmluc2VydGlvbnNcIik7XHJcbmNvbnN0IHNhdmU9c2F1dmVnYXJkZXJFdGF0KGluc2VydGlvbnNDb25zdCk7XHJcbnNldEFkZEZpbHRlckluc2VydGlvbkNhbGxiYWNrKGluc2VydGlvbnNDb25zdCk7XHJcbmZ1bmN0aW9uIGNyZWF0ZUh0bWxJbnNlcnRpb24oaW5zZXJ0aW9uKSB7XHJcbiAgICB2YXIgbGlFbHQgPSBkb2N1bWVudC5jcmVhdGVFbGVtZW50KFwibGlcIik7XHJcbiAgICBsaUVsdC5jbGFzc05hbWUgPSBcImluc2VydGlvblwiO1xyXG4gICAgbGlFbHQuaW5uZXJIVE1MID0gXCI8YSBocmVmPVxcXCIvaW5zZXJ0aW9ucy1wcm9mZXNzaW9ubmVsbGVzL1wiLmNvbmNhdChpbnNlcnRpb24uaWQsIFwiXFxcIiBjbGFzcz1cXFwiXFxcIj5cXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgPGRpdiBjbGFzcz1cXFwiaW5zZXJ0aW9uX19pZFxcXCIgaGlkZGVuPVxcXCJoaWRkZW5cXFwiPlwiKS5jb25jYXQoaW5zZXJ0aW9uLmlkLCBcIjwvZGl2PlxcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICA8aDMgY2xhc3M9XFxcImluc2VydGlvbl9fdGl0cmVcXFwiPlwiKS5jb25jYXQoaW5zZXJ0aW9uLnRpdHJlLCBcIjwvaDM+XFxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIDxkaXYgY2xhc3M9XFxcIlxcXCI+RHVyXFx4RTllIDogXFxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICA8ZGl2IGNsYXNzPVxcXCJpbnNlcnRpb25fX2R1cmVlXFxcIj5cIikuY29uY2F0KGluc2VydGlvbi5kdXJlZSwgXCI8L2Rpdj4sIERcXHhFOWJ1dDogXFxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICA8ZGl2IGNsYXNzPVxcXCJpbnNlcnRpb25fX2RhdGVEZWJcXFwiPlwiKS5jb25jYXQoaW5zZXJ0aW9uLmRhdGVEZWIsIFwiPC9kaXY+XFxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIDwvZGl2PlxcbiAgICAgICAgICAgICAgICAgICAgICAgIDwvYT5cIik7XHJcbiAgICByZXR1cm4gbGlFbHQ7XHJcbn1cclxuZnVuY3Rpb24gZXh0cmFjdEluc2VydGlvbihpbnNlcnRpb25FbHQpIHtcclxuICAgIHJldHVybiB7XHJcbiAgICAgICAgaWQ6IGluc2VydGlvbkVsdC5maXJzdEVsZW1lbnRDaGlsZC5jaGlsZHJlblswXS5sYXN0Q2hpbGQubm9kZVZhbHVlLFxyXG4gICAgICAgIHRpdHJlOiBpbnNlcnRpb25FbHQuZmlyc3RFbGVtZW50Q2hpbGQuY2hpbGRyZW5bMV0ubGFzdENoaWxkLm5vZGVWYWx1ZSxcclxuICAgICAgICBjb250cmF0OiBpbnNlcnRpb25FbHQuZmlyc3RFbGVtZW50Q2hpbGQuY2hpbGRyZW5bM10ubGFzdENoaWxkLm5vZGVWYWx1ZSxcclxuICAgICAgICBkdXJlZTogcGFyc2VJbnQoaW5zZXJ0aW9uRWx0LmZpcnN0RWxlbWVudENoaWxkLmNoaWxkcmVuWzJdLmNoaWxkcmVuWzBdLmxhc3RDaGlsZC5ub2RlVmFsdWUsIDEwKSxcclxuICAgICAgICBkYXRlRGViOiBpbnNlcnRpb25FbHQuZmlyc3RFbGVtZW50Q2hpbGQuY2hpbGRyZW5bMl0uY2hpbGRyZW5bMV0ubGFzdENoaWxkLm5vZGVWYWx1ZSxcclxuICAgICAgICBxdWVyeTogaW5zZXJ0aW9uRWx0XHJcbiAgICB9O1xyXG59XHJcbmZ1bmN0aW9uIGV4dHJhY3RJbnNlcnRpb25zKGluc2VydGlvbnNFbHQpIHtcclxuICAgIHZhciBpbnNlcnRpb25zID0gQXJyYXkuZnJvbShpbnNlcnRpb25zRWx0LmNoaWxkcmVuKTtcclxuICAgIHJldHVybiBpbnNlcnRpb25zLm1hcCgoaW5zZXJ0aW9uKSA9PmV4dHJhY3RJbnNlcnRpb24oaW5zZXJ0aW9uKSk7XHJcbn1cclxuZnVuY3Rpb24gc2F1dmVnYXJkZXJFdGF0KGVsZW1lbnQpIHtcclxuICAgIHJldHVybiB7XHJcbiAgICAgICAgcGFyZW50OiBlbGVtZW50LnBhcmVudE5vZGUsXHJcbiAgICAgICAgbmV4dFNpYmxpbmc6IGVsZW1lbnQubmV4dFNpYmxpbmcsXHJcbiAgICAgICAgY29udGVudTogZWxlbWVudC5pbm5lckhUTUwsXHJcbiAgICAgICAgLy8gQWpvdXRleiBkJ2F1dHJlcyBwcm9wcmnDqXTDqXMgw6Agc2F1dmVnYXJkZXIgYXUgYmVzb2luXHJcbiAgICB9O1xyXG59XHJcbmZ1bmN0aW9uIHNldEFkZEZpbHRlckluc2VydGlvbkNhbGxiYWNrKGluc2VydGlvbnMpIHtcclxuICAgIGNvbnN0IGluc2VydGlvbnNMaXN0ID0gZXh0cmFjdEluc2VydGlvbnMoaW5zZXJ0aW9ucyk7XHJcbiAgICBjb25zdCBpbnRpdHVsZUluc2VydGlvbiA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoXCJpbnB1dC5pbnB1dC5pbnRpdHVsZV9pbnNlcnRpb25cIik7XHJcbiAgICBjb25zdCB0eXBlQ29udHJhdCA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoXCJzZWxlY3QuaW5wdXQudHlwZV9jb250cmF0X2luc2VydGlvblwiKTtcclxuICAgIGNvbnN0IGRhdGVEZWJQcmUgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKFwiaW5wdXQuaW5wdXQuZGF0ZV9kZWJ1dF9hdmFudF9pbnNlcnRpb25cIik7XHJcbiAgICBjb25zdCBkYXRlRGViUG9zdCA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoXCJpbnB1dC5pbnB1dC5kYXRlX2RlYnV0X2FwcmVzX2luc2VydGlvblwiKTtcclxuICAgIGNvbnN0IGR1cmVlID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcihcImlucHV0LmlucHV0LmR1cmVlX2luc2VydGlvblwiKTtcclxuXHJcbiAgICBpbnRpdHVsZUluc2VydGlvbi5hZGRFdmVudExpc3RlbmVyKFwia2V5dXBcIiwgZnVuY3Rpb24gKCkge1xyXG4gICAgICAgIGNvbnN0IGludGl0dWxlID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoXCJpbnRpdHVsZVwiKS52YWx1ZS50b1N0cmluZygpLnRvVXBwZXJDYXNlKCk7XHJcbiAgICAgICAgaW5zZXJ0aW9uc0xpc3QuZm9yRWFjaChmdW5jdGlvbiAoaW5zZXJ0aW9uKSB7XHJcbiAgICAgICAgICAgIGlmICghaW5zZXJ0aW9uWyd0aXRyZSddLnRvVXBwZXJDYXNlKCkuaW5jbHVkZXMoaW50aXR1bGUpKSB7XHJcbiAgICAgICAgICAgICAgICBpZihpbnNlcnRpb25zLmNvbnRhaW5zKGluc2VydGlvblsncXVlcnknXSkpIHtcclxuICAgICAgICAgICAgICAgICAgICBpbnNlcnRpb25zLnJlbW92ZUNoaWxkKGluc2VydGlvblsncXVlcnknXSk7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH0gZWxzZSB7XHJcbiAgICAgICAgICAgICAgICBpZiAoIWluc2VydGlvbnMuY29udGFpbnMoaW5zZXJ0aW9uWydxdWVyeSddKSkge1xyXG4gICAgICAgICAgICAgICAgICAgIGluc2VydGlvbnMuYXBwZW5kQ2hpbGQoaW5zZXJ0aW9uWydxdWVyeSddKTtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH0pO1xyXG4gICAgfSk7XHJcblxyXG4gICAgdHlwZUNvbnRyYXQuYWRkRXZlbnRMaXN0ZW5lcihcImNoYW5nZVwiLCBmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgY29uc3QgY29udHJhdCA9IHR5cGVDb250cmF0Lm9wdGlvbnNbdHlwZUNvbnRyYXQuc2VsZWN0ZWRJbmRleF0udmFsdWU7XHJcbiAgICAgICAgaW5zZXJ0aW9uc0xpc3QuZm9yRWFjaChmdW5jdGlvbiAoaW5zZXJ0aW9uKSB7XHJcbiAgICAgICAgICAgIGlmIChjb250cmF0ID09PSBcIlwiKSB7XHJcbiAgICAgICAgICAgICAgICBpZiAoIWluc2VydGlvbnMuY29udGFpbnMoaW5zZXJ0aW9uWydxdWVyeSddKSkge1xyXG4gICAgICAgICAgICAgICAgICAgIGluc2VydGlvbnMuYXBwZW5kQ2hpbGQoaW5zZXJ0aW9uWydxdWVyeSddKTtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfSBlbHNlIGlmKGNvbnRyYXQgPT09IFwic3RhZ2VcIikge1xyXG4gICAgICAgICAgICAgICAgaWYgKCFpbnNlcnRpb25bJ2NvbnRyYXQnXS50b1VwcGVyQ2FzZSgpLmluY2x1ZGVzKFwiMVwiKSkge1xyXG4gICAgICAgICAgICAgICAgICAgIGlmKGluc2VydGlvbnMuY29udGFpbnMoaW5zZXJ0aW9uWydxdWVyeSddKSkge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBpbnNlcnRpb25zLnJlbW92ZUNoaWxkKGluc2VydGlvblsncXVlcnknXSk7XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfSBlbHNlIHtcclxuICAgICAgICAgICAgICAgICAgICBpZiAoIWluc2VydGlvbnMuY29udGFpbnMoaW5zZXJ0aW9uWydxdWVyeSddKSkge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBpbnNlcnRpb25zLmFwcGVuZENoaWxkKGluc2VydGlvblsncXVlcnknXSk7XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9IGVsc2V7XHJcbiAgICAgICAgICAgICAgICBpZiAoIWluc2VydGlvblsnY29udHJhdCddLnRvVXBwZXJDYXNlKCkuaW5jbHVkZXMoXCIyXCIpKSB7XHJcbiAgICAgICAgICAgICAgICAgICAgaWYoaW5zZXJ0aW9ucy5jb250YWlucyhpbnNlcnRpb25bJ3F1ZXJ5J10pKSB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGluc2VydGlvbnMucmVtb3ZlQ2hpbGQoaW5zZXJ0aW9uWydxdWVyeSddKTtcclxuICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICB9IGVsc2Uge1xyXG4gICAgICAgICAgICAgICAgICAgIGlmICghaW5zZXJ0aW9ucy5jb250YWlucyhpbnNlcnRpb25bJ3F1ZXJ5J10pKSB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGluc2VydGlvbnMuYXBwZW5kQ2hpbGQoaW5zZXJ0aW9uWydxdWVyeSddKTtcclxuICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9KTtcclxuICAgIH0pO1xyXG5cclxuICAgIC8vIG5lIGZvbmN0aW9ubmUgcGFzIHBvdXIgbGUgbW9tZW50XHJcbiAgICBkYXRlRGViUHJlLmFkZEV2ZW50TGlzdGVuZXIoXCJjaGFuZ2VcIiwoKT0+e1xyXG4gICAgICAgIGNvbnN0IGRhdGVEZWJCZWY9IG5ldyBEYXRlKGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwiZGF0ZV9kZWJ1dF9hdmFudFwiKS52YWx1ZSk7XHJcbiAgICAgICAgY29uc3QgZGF0ZURlYkFmdCA9IG5ldyBEYXRlKGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwiZGF0ZV9kZWJ1dF9hcHJlc1wiKS52YWx1ZSk7XHJcbiAgICAgICAgZGF0ZURlYkFmdC5zZXRIb3VycygwLDAsMCwwKTtcclxuICAgICAgICBkYXRlRGViQmVmLnNldEhvdXJzKDAsMCwwLDApO1xyXG4gICAgICAgIGluc2VydGlvbnNMaXN0LmZvckVhY2goZnVuY3Rpb24gKGluc2VydGlvbikge1xyXG4gICAgICAgICAgICBsZXQgZGF0ZURlYj0gbmV3IERhdGUoaW5zZXJ0aW9uLmRhdGVEZWIpO1xyXG4gICAgICAgICAgICBkYXRlRGViLnNldEhvdXJzKDAsMCwwLDApO1xyXG4gICAgICAgICAgICBpZihkYXRlRGViQmVmIDw9IGRhdGVEZWIgPD0gZGF0ZURlYkFmdCl7XHJcbiAgICAgICAgICAgICAgICBpZiAoIWluc2VydGlvbnMuY29udGFpbnMoaW5zZXJ0aW9uWydxdWVyeSddKSkge1xyXG4gICAgICAgICAgICAgICAgICAgIGluc2VydGlvbnMuYXBwZW5kQ2hpbGQoaW5zZXJ0aW9uWydxdWVyeSddKTtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICBlbHNle1xyXG4gICAgICAgICAgICAgICAgaWYgKGluc2VydGlvbnMuY29udGFpbnMoaW5zZXJ0aW9uWydxdWVyeSddKSkge1xyXG4gICAgICAgICAgICAgICAgICAgIGluc2VydGlvbnMucmVtb3ZlQ2hpbGQoaW5zZXJ0aW9uWydxdWVyeSddKTtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH0pO1xyXG4gICAgfSk7XHJcblxyXG4gICAgLy8gbmUgZm9uY3Rpb25uZSBwYXMgcG91ciBsZSBtb21lbnRcclxuICAgIGRhdGVEZWJQb3N0LmFkZEV2ZW50TGlzdGVuZXIoXCJjaGFuZ2VcIiwoKT0+e1xyXG4gICAgICAgIGNvbnN0IGRhdGVEZWJCZWY9IG5ldyBEYXRlKGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwiZGF0ZV9kZWJ1dF9hdmFudFwiKS52YWx1ZSk7XHJcbiAgICAgICAgY29uc3QgZGF0ZURlYkFmdCA9IG5ldyBEYXRlKGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwiZGF0ZV9kZWJ1dF9hcHJlc1wiKS52YWx1ZSk7XHJcbiAgICAgICAgZGF0ZURlYkFmdC5zZXRIb3VycygwLDAsMCwwKTtcclxuICAgICAgICBkYXRlRGViQmVmLnNldEhvdXJzKDAsMCwwLDApO1xyXG4gICAgICAgIGluc2VydGlvbnNMaXN0LmZvckVhY2goZnVuY3Rpb24gKGluc2VydGlvbikge1xyXG4gICAgICAgICAgICBsZXQgZGF0ZURlYj0gbmV3IERhdGUoaW5zZXJ0aW9uLmRhdGVEZWIpO1xyXG4gICAgICAgICAgICBkYXRlRGViLnNldEhvdXJzKDAsMCwwLDApO1xyXG4gICAgICAgICAgICBpZihkYXRlRGViQmVmIDw9IGRhdGVEZWIgPD0gZGF0ZURlYkFmdCl7XHJcbiAgICAgICAgICAgICAgICBpZiAoIWluc2VydGlvbnMuY29udGFpbnMoaW5zZXJ0aW9uWydxdWVyeSddKSkge1xyXG4gICAgICAgICAgICAgICAgICAgIGluc2VydGlvbnMuYXBwZW5kQ2hpbGQoaW5zZXJ0aW9uWydxdWVyeSddKTtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICBlbHNle1xyXG4gICAgICAgICAgICAgICAgaWYgKGluc2VydGlvbnMuY29udGFpbnMoaW5zZXJ0aW9uWydxdWVyeSddKSkge1xyXG4gICAgICAgICAgICAgICAgICAgIGluc2VydGlvbnMucmVtb3ZlQ2hpbGQoaW5zZXJ0aW9uWydxdWVyeSddKTtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH0pO1xyXG4gICAgfSk7XHJcblxyXG4gICAgZHVyZWUuYWRkRXZlbnRMaXN0ZW5lcihcImtleXVwXCIsICgpPT57XHJcbiAgICAgICAgY29uc3QgZHVyZWVJbnNlcnRpb24gPSBwYXJzZUludChkb2N1bWVudC5nZXRFbGVtZW50QnlJZChcImR1cmVlXCIpLnZhbHVlLDEwKTtcclxuICAgICAgICBpbnNlcnRpb25zTGlzdC5mb3JFYWNoKGZ1bmN0aW9uIChpbnNlcnRpb24pIHtcclxuICAgICAgICAgICAgaWYoaW5zZXJ0aW9uLmR1cmVlID09PSBkdXJlZUluc2VydGlvbil7XHJcbiAgICAgICAgICAgICAgICBpZiAoIWluc2VydGlvbnMuY29udGFpbnMoaW5zZXJ0aW9uWydxdWVyeSddKSkge1xyXG4gICAgICAgICAgICAgICAgICAgIGluc2VydGlvbnMuYXBwZW5kQ2hpbGQoaW5zZXJ0aW9uWydxdWVyeSddKTtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfSBlbHNle1xyXG4gICAgICAgICAgICAgICAgaWYgKGluc2VydGlvbnMuY29udGFpbnMoaW5zZXJ0aW9uWydxdWVyeSddKSkge1xyXG4gICAgICAgICAgICAgICAgICAgIGluc2VydGlvbnMucmVtb3ZlQ2hpbGQoaW5zZXJ0aW9uWydxdWVyeSddKTtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICBpZighZHVyZWVJbnNlcnRpb24pe1xyXG4gICAgICAgICAgICAgICAgaWYgKCFpbnNlcnRpb25zLmNvbnRhaW5zKGluc2VydGlvblsncXVlcnknXSkpIHtcclxuICAgICAgICAgICAgICAgICAgICBpbnNlcnRpb25zLmFwcGVuZENoaWxkKGluc2VydGlvblsncXVlcnknXSk7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9KTtcclxuICAgIH0pO1xyXG5cclxuICAgIGR1cmVlLmFkZEV2ZW50TGlzdGVuZXIoXCJjaGFuZ2VcIiwgKCk9PntcclxuICAgICAgICBjb25zdCBkdXJlZUluc2VydGlvbiA9IHBhcnNlSW50KGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwiZHVyZWVcIikudmFsdWUsMTApO1xyXG4gICAgICAgIGluc2VydGlvbnNMaXN0LmZvckVhY2goZnVuY3Rpb24gKGluc2VydGlvbikge1xyXG4gICAgICAgICAgICBpZihpbnNlcnRpb24uZHVyZWUgPT09IGR1cmVlSW5zZXJ0aW9uKXtcclxuICAgICAgICAgICAgICAgIGlmICghaW5zZXJ0aW9ucy5jb250YWlucyhpbnNlcnRpb25bJ3F1ZXJ5J10pKSB7XHJcbiAgICAgICAgICAgICAgICAgICAgaW5zZXJ0aW9ucy5hcHBlbmRDaGlsZChpbnNlcnRpb25bJ3F1ZXJ5J10pO1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9IGVsc2V7XHJcbiAgICAgICAgICAgICAgICBpZiAoaW5zZXJ0aW9ucy5jb250YWlucyhpbnNlcnRpb25bJ3F1ZXJ5J10pKSB7XHJcbiAgICAgICAgICAgICAgICAgICAgaW5zZXJ0aW9ucy5yZW1vdmVDaGlsZChpbnNlcnRpb25bJ3F1ZXJ5J10pO1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIGlmKCFkdXJlZUluc2VydGlvbil7XHJcbiAgICAgICAgICAgICAgICBpZiAoIWluc2VydGlvbnMuY29udGFpbnMoaW5zZXJ0aW9uWydxdWVyeSddKSkge1xyXG4gICAgICAgICAgICAgICAgICAgIGluc2VydGlvbnMuYXBwZW5kQ2hpbGQoaW5zZXJ0aW9uWydxdWVyeSddKTtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH0pO1xyXG4gICAgfSk7XHJcbn0iXSwibmFtZXMiOlsiaW5zZXJ0aW9uc0NvbnN0IiwiZG9jdW1lbnQiLCJxdWVyeVNlbGVjdG9yIiwic2F2ZSIsInNhdXZlZ2FyZGVyRXRhdCIsInNldEFkZEZpbHRlckluc2VydGlvbkNhbGxiYWNrIiwiY3JlYXRlSHRtbEluc2VydGlvbiIsImluc2VydGlvbiIsImxpRWx0IiwiY3JlYXRlRWxlbWVudCIsImNsYXNzTmFtZSIsImlubmVySFRNTCIsImNvbmNhdCIsImlkIiwidGl0cmUiLCJkdXJlZSIsImRhdGVEZWIiLCJleHRyYWN0SW5zZXJ0aW9uIiwiaW5zZXJ0aW9uRWx0IiwiZmlyc3RFbGVtZW50Q2hpbGQiLCJjaGlsZHJlbiIsImxhc3RDaGlsZCIsIm5vZGVWYWx1ZSIsImNvbnRyYXQiLCJwYXJzZUludCIsInF1ZXJ5IiwiZXh0cmFjdEluc2VydGlvbnMiLCJpbnNlcnRpb25zRWx0IiwiaW5zZXJ0aW9ucyIsIkFycmF5IiwiZnJvbSIsIm1hcCIsImVsZW1lbnQiLCJwYXJlbnQiLCJwYXJlbnROb2RlIiwibmV4dFNpYmxpbmciLCJjb250ZW51IiwiaW5zZXJ0aW9uc0xpc3QiLCJpbnRpdHVsZUluc2VydGlvbiIsInR5cGVDb250cmF0IiwiZGF0ZURlYlByZSIsImRhdGVEZWJQb3N0IiwiYWRkRXZlbnRMaXN0ZW5lciIsImludGl0dWxlIiwiZ2V0RWxlbWVudEJ5SWQiLCJ2YWx1ZSIsInRvU3RyaW5nIiwidG9VcHBlckNhc2UiLCJmb3JFYWNoIiwiaW5jbHVkZXMiLCJjb250YWlucyIsInJlbW92ZUNoaWxkIiwiYXBwZW5kQ2hpbGQiLCJvcHRpb25zIiwic2VsZWN0ZWRJbmRleCIsImRhdGVEZWJCZWYiLCJEYXRlIiwiZGF0ZURlYkFmdCIsInNldEhvdXJzIiwiZHVyZWVJbnNlcnRpb24iXSwic291cmNlUm9vdCI6IiJ9