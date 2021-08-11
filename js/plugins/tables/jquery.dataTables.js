/*
 * File:        jquery.dataTables.min.js
 * Version:     1.9.1
 * Author:      Allan Jardine (www.sprymedia.co.uk)
 * Info:        www.datatables.net
 * 
 * Copyright 2008-2012 Allan Jardine, all rights reserved.
 *
 * This source file is free software, under either the GPL v2 license or a
 * BSD style license, available at:
 *   http://datatables.net/license_gpl2
 *   http://datatables.net/license_bsd
 * 
 * This source file is distributed in the hope that it will be useful, but 
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY 
 * or FITNESS FOR A PARTICULAR PURPOSE. See the license files for details.
 */
(function (h, V, l, m) {
    var j = function (e) {
            function o(a, b) {
                var c = j.defaults.columns,
                    d = a.aoColumns.length,
                    c = h.extend({}, j.models.oColumn, c, {
                        sSortingClass: a.oClasses.sSortable,
                        sSortingClassJUI: a.oClasses.sSortJUI,
                        nTh: b ? b : l.createElement("th"),
                        sTitle: c.sTitle ? c.sTitle : b ? b.innerHTML : "",
                        aDataSort: c.aDataSort ? c.aDataSort : [d],
                        mDataProp: c.mDataProp ? c.oDefaults : d
                    });
                a.aoColumns.push(c);
                if (a.aoPreSearchCols[d] === m || null === a.aoPreSearchCols[d]) a.aoPreSearchCols[d] = h.extend({}, j.models.oSearch);
                else {
                    c = a.aoPreSearchCols[d];
                    if (c.bRegex === m) c.bRegex = !0;
                    if (c.bSmart === m) c.bSmart = !0;
                    if (c.bCaseInsensitive === m) c.bCaseInsensitive = !0
                }
                s(a, d, null)
            }
            function s(a, b, c) {
                b = a.aoColumns[b];
                if (c !== m && null !== c) {
                    if (c.sType !== m) b.sType = c.sType, b._bAutoType = !1;
                    h.extend(b, c);
                    p(b, c, "sWidth", "sWidthOrig");
                    if (c.iDataSort !== m) b.aDataSort = [c.iDataSort];
                    p(b, c, "aDataSort")
                }
                b.fnGetData = W(b.mDataProp);
                b.fnSetData = ta(b.mDataProp);
                if (!a.oFeatures.bSort) b.bSortable = !1;
                if (!b.bSortable || -1 == h.inArray("asc", b.asSorting) && -1 == h.inArray("desc", b.asSorting)) b.sSortingClass = a.oClasses.sSortableNone, b.sSortingClassJUI = "";
                else if (b.bSortable || -1 == h.inArray("asc", b.asSorting) && -1 == h.inArray("desc", b.asSorting)) b.sSortingClass = a.oClasses.sSortable, b.sSortingClassJUI = a.oClasses.sSortJUI;
                else if (-1 != h.inArray("asc", b.asSorting) && -1 == h.inArray("desc", b.asSorting)) b.sSortingClass = a.oClasses.sSortableAsc, b.sSortingClassJUI = a.oClasses.sSortJUIAscAllowed;
                else if (-1 == h.inArray("asc", b.asSorting) && -1 != h.inArray("desc", b.asSorting)) b.sSortingClass = a.oClasses.sSortableDesc, b.sSortingClassJUI = a.oClasses.sSortJUIDescAllowed
            }
            function k(a) {
                if (!1 === a.oFeatures.bAutoWidth) return !1;
                ba(a);
                for (var b = 0, c = a.aoColumns.length; b < c; b++) a.aoColumns[b].nTh.style.width = a.aoColumns[b].sWidth
            }
            function x(a, b) {
                for (var c = -1, d = 0; d < a.aoColumns.length; d++) if (!0 === a.aoColumns[d].bVisible && c++, c == b) return d;
                return null
            }
            function r(a, b) {
                for (var c = -1, d = 0; d < a.aoColumns.length; d++) if (!0 === a.aoColumns[d].bVisible && c++, d == b) return !0 === a.aoColumns[d].bVisible ? c : null;
                return null
            }
            function v(a) {
                for (var b = 0, c = 0; c < a.aoColumns.length; c++)!0 === a.aoColumns[c].bVisible && b++;
                return b
            }
            function A(a) {
                for (var b = j.ext.aTypes, c = b.length, d = 0; d < c; d++) {
                    var f = b[d](a);
                    if (null !== f) return f
                }
                return "string"
            }
            function E(a, b) {
                for (var c = b.split(","), d = [], f = 0, g = a.aoColumns.length; f < g; f++) for (var i = 0; i < g; i++) if (a.aoColumns[f].sName == c[i]) {
                    d.push(i);
                    break
                }
                return d
            }
            function y(a) {
                for (var b = "", c = 0, d = a.aoColumns.length; c < d; c++) b += a.aoColumns[c].sName + ",";
                return b.length == d ? "" : b.slice(0, -1)
            }
            function J(a, b, c, d) {
                var f, g, i, e, u;
                if (b) for (f = b.length - 1; 0 <= f; f--) {
                    var n = b[f].aTargets;
                    h.isArray(n) || F(a, 1, "aTargets must be an array of targets, not a " + typeof n);
                    for (g = 0, i = n.length; g < i; g++) if ("number" === typeof n[g] && 0 <= n[g]) {
                        for (; a.aoColumns.length <= n[g];) o(a);
                        d(n[g], b[f])
                    } else if ("number" === typeof n[g] && 0 > n[g]) d(a.aoColumns.length + n[g], b[f]);
                    else if ("string" === typeof n[g]) for (e = 0, u = a.aoColumns.length; e < u; e++)("_all" == n[g] || h(a.aoColumns[e].nTh).hasClass(n[g])) && d(e, b[f])
                }
                if (c) for (f = 0, a = c.length; f < a; f++) d(f, c[f])
            }
            function H(a, b) {
                var c;
                c = h.isArray(b) ? b.slice() : h.extend(!0, {}, b);
                var d = a.aoData.length,
                    f = h.extend(!0, {}, j.models.oRow);
                f._aData = c;
                a.aoData.push(f);
                for (var g, f = 0, i = a.aoColumns.length; f < i; f++) if (c = a.aoColumns[f], "function" === typeof c.fnRender && c.bUseRendered && null !== c.mDataProp ? I(a, d, f, R(a, d, f)) : I(a, d, f, w(a, d, f)), c._bAutoType && "string" != c.sType && (g = w(a, d, f, "type"), null !== g && "" !== g)) if (g = A(g), null === c.sType) c.sType = g;
                else if (c.sType != g && "html" != c.sType) c.sType = "string";
                a.aiDisplayMaster.push(d);
                a.oFeatures.bDeferRender || ca(a, d);
                return d
            }
            function ua(a) {
                var b, c, d, f, g, i, e, u, n;
                if (a.bDeferLoading || null === a.sAjaxSource) {
                    e = a.nTBody.childNodes;
                    for (b = 0, c = e.length; b < c; b++) if ("TR" == e[b].nodeName.toUpperCase()) {
                        u = a.aoData.length;
                        e[b]._DT_RowIndex = u;
                        a.aoData.push(h.extend(!0, {}, j.models.oRow, {
                            nTr: e[b]
                        }));
                        a.aiDisplayMaster.push(u);
                        i = e[b].childNodes;
                        g = 0;
                        for (d = 0, f = i.length; d < f; d++) if (n = i[d].nodeName.toUpperCase(), "TD" == n || "TH" == n) I(a, u, g, h.trim(i[d].innerHTML)), g++
                    }
                }
                e = S(a);
                i = [];
                for (b = 0, c = e.length; b < c; b++) for (d = 0, f = e[b].childNodes.length; d < f; d++) g = e[b].childNodes[d], n = g.nodeName.toUpperCase(), ("TD" == n || "TH" == n) && i.push(g);
                for (f = 0, e = a.aoColumns.length; f < e; f++) {
                    n = a.aoColumns[f];
                    if (null === n.sTitle) n.sTitle = n.nTh.innerHTML;
                    g = n._bAutoType;
                    u = "function" === typeof n.fnRender;
                    var o = null !== n.sClass,
                        k = n.bVisible,
                        m, s;
                    if (g || u || o || !k) for (b = 0, c = a.aoData.length; b < c; b++) {
                        d = a.aoData[b];
                        m = i[b * e + f];
                        if (g && "string" != n.sType && (s = w(a, b, f, "type"), "" !== s)) if (s = A(s), null === n.sType) n.sType = s;
                        else if (n.sType != s && "html" != n.sType) n.sType = "string";
                        if ("function" === typeof n.mDataProp) m.innerHTML = w(a, b, f, "display");
                        if (u) s = R(a, b, f), m.innerHTML = s, n.bUseRendered && I(a, b, f, s);
                        o && (m.className += " " + n.sClass);
                        k ? d._anHidden[f] = null : (d._anHidden[f] = m, m.parentNode.removeChild(m));
                        n.fnCreatedCell && n.fnCreatedCell.call(a.oInstance, m, w(a, b, f, "display"), d._aData, b, f)
                    }
                }
                if (0 !== a.aoRowCreatedCallback.length) for (b = 0, c = a.aoData.length; b < c; b++) d = a.aoData[b], D(a, "aoRowCreatedCallback", null, [d.nTr, d._aData, b])
            }
            function K(a, b) {
                return b._DT_RowIndex !== m ? b._DT_RowIndex : null
            }
            function da(a, b, c) {
                for (var b = L(a, b), d = 0, a = a.aoColumns.length; d < a; d++) if (b[d] === c) return d;
                return -1
            }
            function X(a, b, c) {
                for (var d = [], f = 0, g = a.aoColumns.length; f < g; f++) d.push(w(a, b, f, c));
                return d
            }
            function w(a, b, c, d) {
                var f = a.aoColumns[c];
                if ((c = f.fnGetData(a.aoData[b]._aData, d)) === m) {
                    if (a.iDrawError != a.iDraw && null === f.sDefaultContent) F(a, 0, "Requested unknown parameter " + ("function" == typeof f.mDataProp ? "{mDataprop function}" : "'" + f.mDataProp + "'") + " from the data source for row " + b), a.iDrawError = a.iDraw;
                    return f.sDefaultContent
                }
                if (null === c && null !== f.sDefaultContent) c = f.sDefaultContent;
                else if ("function" === typeof c) return c();
                return "display" == d && null === c ? "" : c
            }
            function I(a, b, c, d) {
                a.aoColumns[c].fnSetData(a.aoData[b]._aData, d)
            }
            function W(a) {
                if (null === a) return function () {
                    return null
                };
                if ("function" === typeof a) return function (b, d) {
                    return a(b, d)
                };
                if ("string" === typeof a && -1 != a.indexOf(".")) {
                    var b = a.split(".");
                    return function (a) {
                        for (var d = 0, f = b.length; d < f; d++) if (a = a[b[d]], a === m) return m;
                        return a
                    }
                }
                return function (b) {
                    return b[a]
                }
            }
            function ta(a) {
                if (null === a) return function () {};
                if ("function" === typeof a) return function (b, d) {
                    a(b, "set", d)
                };
                if ("string" === typeof a && -1 != a.indexOf(".")) {
                    var b = a.split(".");
                    return function (a, d) {
                        for (var f = 0, g = b.length - 1; f < g; f++) if (a = a[b[f]], a === m) return;
                        a[b[b.length - 1]] = d
                    }
                }
                return function (b, d) {
                    b[a] = d
                }
            }
            function Y(a) {
                for (var b = [], c = a.aoData.length, d = 0; d < c; d++) b.push(a.aoData[d]._aData);
                return b
            }
            function ea(a) {
                a.aoData.splice(0, a.aoData.length);
                a.aiDisplayMaster.splice(0, a.aiDisplayMaster.length);
                a.aiDisplay.splice(0, a.aiDisplay.length);
                B(a)
            }
            function fa(a, b) {
                for (var c = -1, d = 0, f = a.length; d < f; d++) a[d] == b ? c = d : a[d] > b && a[d]--; - 1 != c && a.splice(c, 1)
            }
            function R(a, b, c) {
                var d = a.aoColumns[c];
                return d.fnRender({
                    iDataRow: b,
                    iDataColumn: c,
                    oSettings: a,
                    aData: a.aoData[b]._aData,
                    mDataProp: d.mDataProp
                }, w(a, b, c, "display"))
            }
            function ca(a, b) {
                var c = a.aoData[b],
                    d;
                if (null === c.nTr) {
                    c.nTr = l.createElement("tr");
                    c.nTr._DT_RowIndex = b;
                    if (c._aData.DT_RowId) c.nTr.id = c._aData.DT_RowId;
                    c._aData.DT_RowClass && h(c.nTr).addClass(c._aData.DT_RowClass);
                    for (var f = 0, g = a.aoColumns.length; f < g; f++) {
                        var i = a.aoColumns[f];
                        d = l.createElement(i.sCellType);
                        d.innerHTML = "function" === typeof i.fnRender && (!i.bUseRendered || null === i.mDataProp) ? R(a, b, f) : w(a, b, f, "display");
                        if (null !== i.sClass) d.className = i.sClass;
                        i.bVisible ? (c.nTr.appendChild(d), c._anHidden[f] = null) : c._anHidden[f] = d;
                        i.fnCreatedCell && i.fnCreatedCell.call(a.oInstance, d, w(a, b, f, "display"), c._aData, b, f)
                    }
                    D(a, "aoRowCreatedCallback", null, [c.nTr, c._aData, b])
                }
            }
            function va(a) {
                var b, c, d;
                if (0 !== a.nTHead.getElementsByTagName("th").length) for (b = 0, d = a.aoColumns.length; b < d; b++) {
                    if (c = a.aoColumns[b].nTh, c.setAttribute("role", "columnheader"), a.aoColumns[b].bSortable && (c.setAttribute("tabindex", a.iTabIndex), c.setAttribute("aria-controls", a.sTableId)), null !== a.aoColumns[b].sClass && h(c).addClass(a.aoColumns[b].sClass), a.aoColumns[b].sTitle != c.innerHTML) c.innerHTML = a.aoColumns[b].sTitle
                } else {
                    var f = l.createElement("tr");
                    for (b = 0, d = a.aoColumns.length; b < d; b++) c = a.aoColumns[b].nTh, c.innerHTML = a.aoColumns[b].sTitle, c.setAttribute("tabindex", "0"), null !== a.aoColumns[b].sClass && h(c).addClass(a.aoColumns[b].sClass), f.appendChild(c);
                    h(a.nTHead).html("")[0].appendChild(f);
                    T(a.aoHeader, a.nTHead)
                }
                h(a.nTHead).children("tr").attr("role", "row");
                if (a.bJUI) for (b = 0, d = a.aoColumns.length; b < d; b++) {
                    c = a.aoColumns[b].nTh;
                    f = l.createElement("div");
                    f.className = a.oClasses.sSortJUIWrapper;
                    h(c).contents().appendTo(f);
                    var g = l.createElement("span");
                    g.className = a.oClasses.sSortIcon;
                    f.appendChild(g);
                    c.appendChild(f)
                }
                if (a.oFeatures.bSort) for (b = 0; b < a.aoColumns.length; b++)!1 !== a.aoColumns[b].bSortable ? ga(a, a.aoColumns[b].nTh, b) : h(a.aoColumns[b].nTh).addClass(a.oClasses.sSortableNone);
                "" !== a.oClasses.sFooterTH && h(a.nTFoot).children("tr").children("th").addClass(a.oClasses.sFooterTH);
                if (null !== a.nTFoot) {
                    c = O(a, null, a.aoFooter);
                    for (b = 0, d = a.aoColumns.length; b < d; b++) if (c[b]) a.aoColumns[b].nTf = c[b], a.aoColumns[b].sClass && h(c[b]).addClass(a.aoColumns[b].sClass)
                }
            }
            function U(a, b, c) {
                var d, f, g, i = [],
                    e = [],
                    h = a.aoColumns.length,
                    n;
                c === m && (c = !1);
                for (d = 0, f = b.length; d < f; d++) {
                    i[d] = b[d].slice();
                    i[d].nTr = b[d].nTr;
                    for (g = h - 1; 0 <= g; g--)!a.aoColumns[g].bVisible && !c && i[d].splice(g, 1);
                    e.push([])
                }
                for (d = 0, f = i.length; d < f; d++) {
                    if (a = i[d].nTr) for (; g = a.firstChild;) a.removeChild(g);
                    for (g = 0, b = i[d].length; g < b; g++) if (n = h = 1, e[d][g] === m) {
                        a.appendChild(i[d][g].cell);
                        for (e[d][g] = 1; i[d + h] !== m && i[d][g].cell == i[d + h][g].cell;) e[d + h][g] = 1, h++;
                        for (; i[d][g + n] !== m && i[d][g].cell == i[d][g + n].cell;) {
                            for (c = 0; c < h; c++) e[d + c][g + n] = 1;
                            n++
                        }
                        i[d][g].cell.rowSpan = h;
                        i[d][g].cell.colSpan = n
                    }
                }
            }
            function z(a) {
                var b, c, d = [],
                    f = 0,
                    g = a.asStripeClasses.length;
                b = a.aoOpenRows.length;
                c = D(a, "aoPreDrawCallback", "preDraw", [a]);
                if (-1 !== h.inArray(!1, c)) G(a, !1);
                else {
                    a.bDrawing = !0;
                    if (a.iInitDisplayStart !== m && -1 != a.iInitDisplayStart) a._iDisplayStart = a.oFeatures.bServerSide ? a.iInitDisplayStart : a.iInitDisplayStart >= a.fnRecordsDisplay() ? 0 : a.iInitDisplayStart, a.iInitDisplayStart = -1, B(a);
                    if (a.bDeferLoading) a.bDeferLoading = !1, a.iDraw++;
                    else if (a.oFeatures.bServerSide) {
                        if (!a.bDestroying && !wa(a)) return
                    } else a.iDraw++;
                    if (0 !== a.aiDisplay.length) {
                        var i = a._iDisplayStart;
                        c = a._iDisplayEnd;
                        if (a.oFeatures.bServerSide) i = 0, c = a.aoData.length;
                        for (; i < c; i++) {
                            var e = a.aoData[a.aiDisplay[i]];
                            null === e.nTr && ca(a, a.aiDisplay[i]);
                            var j = e.nTr;
                            if (0 !== g) {
                                var n = a.asStripeClasses[f % g];
                                if (e._sRowStripe != n) h(j).removeClass(e._sRowStripe).addClass(n), e._sRowStripe = n
                            }
                            D(a, "aoRowCallback", null, [j, a.aoData[a.aiDisplay[i]]._aData, f, i]);
                            d.push(j);
                            f++;
                            if (0 !== b) for (e = 0; e < b; e++) if (j == a.aoOpenRows[e].nParent) {
                                d.push(a.aoOpenRows[e].nTr);
                                break
                            }
                        }
                    } else {
                        d[0] = l.createElement("tr");
                        if (a.asStripeClasses[0]) d[0].className = a.asStripeClasses[0];
                        b = a.oLanguage;
                        g = b.sZeroRecords;
                        if (1 == a.iDraw && null !== a.sAjaxSource && !a.oFeatures.bServerSide) g = b.sLoadingRecords;
                        else if (b.sEmptyTable && 0 === a.fnRecordsTotal()) g = b.sEmptyTable;
                        b = l.createElement("td");
                        b.setAttribute("valign", "top");
                        b.colSpan = v(a);
                        b.className = a.oClasses.sRowEmpty;
                        b.innerHTML = ha(a, g);
                        d[f].appendChild(b)
                    }
                    D(a, "aoHeaderCallback", "header", [h(a.nTHead).children("tr")[0], Y(a), a._iDisplayStart, a.fnDisplayEnd(), a.aiDisplay]);
                    D(a, "aoFooterCallback", "footer", [h(a.nTFoot).children("tr")[0], Y(a), a._iDisplayStart, a.fnDisplayEnd(), a.aiDisplay]);
                    f = l.createDocumentFragment();
                    b = l.createDocumentFragment();
                    if (a.nTBody) {
                        g = a.nTBody.parentNode;
                        b.appendChild(a.nTBody);
                        if (!a.oScroll.bInfinite || !a._bInitComplete || a.bSorted || a.bFiltered) for (; b = a.nTBody.firstChild;) a.nTBody.removeChild(b);
                        for (b = 0, c = d.length; b < c; b++) f.appendChild(d[b]);
                        a.nTBody.appendChild(f);
                        null !== g && g.appendChild(a.nTBody)
                    }
                    D(a, "aoDrawCallback", "draw", [a]);
                    a.bSorted = !1;
                    a.bFiltered = !1;
                    a.bDrawing = !1;
                    a.oFeatures.bServerSide && (G(a, !1), a._bInitComplete || Z(a))
                }
            }
            function $(a) {
                a.oFeatures.bSort ? P(a, a.oPreviousSearch) : a.oFeatures.bFilter ? M(a, a.oPreviousSearch) : (B(a), z(a))
            }
            function xa(a) {
                var b = h("<div></div>")[0];
                a.nTable.parentNode.insertBefore(b, a.nTable);
                a.nTableWrapper = h('<div id="' + a.sTableId + '_wrapper" class="' + a.oClasses.sWrapper + '" role="grid"></div>')[0];
                a.nTableReinsertBefore = a.nTable.nextSibling;
                for (var c = a.nTableWrapper, d = a.sDom.split(""), f, g, i, e, u, n, o, k = 0; k < d.length; k++) {
                    g = 0;
                    i = d[k];
                    if ("<" == i) {
                        e = h("<div></div>")[0];
                        u = d[k + 1];
                        if ("'" == u || '"' == u) {
                            n = "";
                            for (o = 2; d[k + o] != u;) n += d[k + o], o++;
                            "H" == n ? n = "tablePars" : "F" == n && (n = "fg-toolbar tableFooter"); - 1 != n.indexOf(".") ? (u = n.split("."), e.id = u[0].substr(1, u[0].length - 1), e.className = u[1]) : "#" == n.charAt(0) ? e.id = n.substr(1, n.length - 1) : e.className = n;
                            k += o
                        }
                        c.appendChild(e);
                        c = e
                    } else if (">" == i) c = c.parentNode;
                    else if ("l" == i && a.oFeatures.bPaginate && a.oFeatures.bLengthChange) f = ya(a), g = 1;
                    else if ("f" == i && a.oFeatures.bFilter) f = za(a), g = 1;
                    else if ("r" == i && a.oFeatures.bProcessing) f = Aa(a), g = 1;
                    else if ("t" == i) f = Ba(a), g = 1;
                    else if ("i" == i && a.oFeatures.bInfo) f = Ca(a), g = 1;
                    else if ("p" == i && a.oFeatures.bPaginate) f = Da(a), g = 1;
                    else if (0 !== j.ext.aoFeatures.length) {
                        e = j.ext.aoFeatures;
                        o = 0;
                        for (u = e.length; o < u; o++) if (i == e[o].cFeature) {
                            (f = e[o].fnInit(a)) && (g = 1);
                            break
                        }
                    }
                    1 == g && null !== f && ("object" !== typeof a.aanFeatures[i] && (a.aanFeatures[i] = []), a.aanFeatures[i].push(f), c.appendChild(f))
                }
                b.parentNode.replaceChild(a.nTableWrapper, b)
            }
            function T(a, b) {
                var c = h(b).children("tr"),
                    d, f, g, i, e, j, n, o;
                a.splice(0, a.length);
                for (f = 0, j = c.length; f < j; f++) a.push([]);
                for (f = 0, j = c.length; f < j; f++) for (g = 0, n = c[f].childNodes.length; g < n; g++) if (d = c[f].childNodes[g], "TD" == d.nodeName.toUpperCase() || "TH" == d.nodeName.toUpperCase()) {
                    var k = 1 * d.getAttribute("colspan"),
                        m = 1 * d.getAttribute("rowspan"),
                        k = !k || 0 === k || 1 === k ? 1 : k,
                        m = !m || 0 === m || 1 === m ? 1 : m;
                    for (i = 0; a[f][i];) i++;
                    o = i;
                    for (e = 0; e < k; e++) for (i = 0; i < m; i++) a[f + i][o + e] = {
                        cell: d,
                        unique: 1 == k ? !0 : !1
                    }, a[f + i].nTr = c[f]
                }
            }
            function O(a, b, c) {
                var d = [];
                if (!c) c = a.aoHeader, b && (c = [], T(c, b));
                for (var b = 0, f = c.length; b < f; b++) for (var g = 0, i = c[b].length; g < i; g++) if (c[b][g].unique && (!d[g] || !a.bSortCellsTop)) d[g] = c[b][g].cell;
                return d
            }
            function wa(a) {
                if (a.bAjaxDataGet) {
                    a.iDraw++;
                    G(a, !0);
                    var b = Ea(a);
                    ia(a, b);
                    a.fnServerData.call(a.oInstance, a.sAjaxSource, b, function (b) {
                        Fa(a, b)
                    }, a);
                    return !1
                }
                return !0
            }
            function Ea(a) {
                var b = a.aoColumns.length,
                    c = [],
                    d, f, g, i;
                c.push({
                    name: "sEcho",
                    value: a.iDraw
                });
                c.push({
                    name: "iColumns",
                    value: b
                });
                c.push({
                    name: "sColumns",
                    value: y(a)
                });
                c.push({
                    name: "iDisplayStart",
                    value: a._iDisplayStart
                });
                c.push({
                    name: "iDisplayLength",
                    value: !1 !== a.oFeatures.bPaginate ? a._iDisplayLength : -1
                });
                for (g = 0; g < b; g++) d = a.aoColumns[g].mDataProp, c.push({
                    name: "mDataProp_" + g,
                    value: "function" === typeof d ? "function" : d
                });
                if (!1 !== a.oFeatures.bFilter) {
                    c.push({
                        name: "sSearch",
                        value: a.oPreviousSearch.sSearch
                    });
                    c.push({
                        name: "bRegex",
                        value: a.oPreviousSearch.bRegex
                    });
                    for (g = 0; g < b; g++) c.push({
                        name: "sSearch_" + g,
                        value: a.aoPreSearchCols[g].sSearch
                    }), c.push({
                        name: "bRegex_" + g,
                        value: a.aoPreSearchCols[g].bRegex
                    }), c.push({
                        name: "bSearchable_" + g,
                        value: a.aoColumns[g].bSearchable
                    })
                }
                if (!1 !== a.oFeatures.bSort) {
                    var e = 0;
                    d = null !== a.aaSortingFixed ? a.aaSortingFixed.concat(a.aaSorting) : a.aaSorting.slice();
                    for (g = 0; g < d.length; g++) {
                        f = a.aoColumns[d[g][0]].aDataSort;
                        for (i = 0; i < f.length; i++) c.push({
                            name: "iSortCol_" + e,
                            value: f[i]
                        }), c.push({
                            name: "sSortDir_" + e,
                            value: d[g][1]
                        }), e++
                    }
                    c.push({
                        name: "iSortingCols",
                        value: e
                    });
                    for (g = 0; g < b; g++) c.push({
                        name: "bSortable_" + g,
                        value: a.aoColumns[g].bSortable
                    })
                }
                return c
            }
            function ia(a, b) {
                D(a, "aoServerParams", "serverParams", [b])
            }
            function Fa(a, b) {
                if (b.sEcho !== m) {
                    if (1 * b.sEcho < a.iDraw) return;
                    a.iDraw = 1 * b.sEcho
                }(!a.oScroll.bInfinite || a.oScroll.bInfinite && (a.bSorted || a.bFiltered)) && ea(a);
                a._iRecordsTotal = parseInt(b.iTotalRecords, 10);
                a._iRecordsDisplay = parseInt(b.iTotalDisplayRecords, 10);
                var c = y(a),
                    c = b.sColumns !== m && "" !== c && b.sColumns != c,
                    d;
                c && (d = E(a, b.sColumns));
                for (var f = W(a.sAjaxDataProp)(b), g = 0, i = f.length; g < i; g++) if (c) {
                    for (var e = [], h = 0, n = a.aoColumns.length; h < n; h++) e.push(f[g][d[h]]);
                    H(a, e)
                } else H(a, f[g]);
                a.aiDisplay = a.aiDisplayMaster.slice();
                a.bAjaxDataGet = !1;
                z(a);
                a.bAjaxDataGet = !0;
                G(a, !1)
            }
            function za(a) {
                var b = a.oPreviousSearch,
                    c = a.oLanguage.sSearch,
                    c = -1 !== c.indexOf("_INPUT_") ? c.replace("_INPUT_", '<input type="text" />') : "" === c ? '<input type="text" />' : c + ' <input type="text"  placeholder="Digite o filtro..." /><div class="srch"></div>',
                    d = l.createElement("div");
                d.className = a.oClasses.sFilter;
                d.innerHTML = "<label>" + c + "</label>";
                if (!a.aanFeatures.f) d.id = a.sTableId + "_filter";
                c = h('input[type="text"]', d);
                d._DT_Input = c[0];
                c.val(b.sSearch.replace('"', "&quot;"));
                c.bind("keyup.DT", function () {
                    for (var c = a.aanFeatures.f, d = "" === this.value ? "" : this.value, i = 0, e = c.length; i < e; i++) c[i] != h(this).parents("div.dataTables_filter")[0] && h(c[i]._DT_Input).val(d);
                    d != b.sSearch && M(a, {
                        sSearch: d,
                        bRegex: b.bRegex,
                        bSmart: b.bSmart,
                        bCaseInsensitive: b.bCaseInsensitive
                    })
                });
                c.attr("aria-controls", a.sTableId).bind("keypress.DT", function (a) {
                    if (13 == a.keyCode) return !1
                });
                return d
            }
            function M(a, b, c) {
                var d = a.oPreviousSearch,
                    f = a.aoPreSearchCols,
                    g = function (a) {
                        d.sSearch = a.sSearch;
                        d.bRegex = a.bRegex;
                        d.bSmart = a.bSmart;
                        d.bCaseInsensitive = a.bCaseInsensitive
                    };
                if (a.oFeatures.bServerSide) g(b);
                else {
                    Ga(a, b.sSearch, c, b.bRegex, b.bSmart, b.bCaseInsensitive);
                    g(b);
                    for (b = 0; b < a.aoPreSearchCols.length; b++) Ha(a, f[b].sSearch, b, f[b].bRegex, f[b].bSmart, f[b].bCaseInsensitive);
                    Ia(a)
                }
                a.bFiltered = !0;
                h(a.oInstance).trigger("filter", a);
                a._iDisplayStart = 0;
                B(a);
                z(a);
                ja(a, 0)
            }
            function Ia(a) {
                for (var b = j.ext.afnFiltering, c = 0, d = b.length; c < d; c++) for (var f = 0, g = 0, i = a.aiDisplay.length; g < i; g++) {
                    var e = a.aiDisplay[g - f];
                    b[c](a, X(a, e, "filter"), e) || (a.aiDisplay.splice(g - f, 1), f++)
                }
            }
            function Ha(a, b, c, d, f, g) {
                if ("" !== b) for (var i = 0, b = ka(b, d, f, g), d = a.aiDisplay.length - 1; 0 <= d; d--) f = la(w(a, a.aiDisplay[d], c, "filter"), a.aoColumns[c].sType), b.test(f) || (a.aiDisplay.splice(d, 1), i++)
            }
            function Ga(a, b, c, d, f, g) {
                d = ka(b, d, f, g);
                f = a.oPreviousSearch;
                c || (c = 0);
                0 !== j.ext.afnFiltering.length && (c = 1);
                if (0 >= b.length) a.aiDisplay.splice(0, a.aiDisplay.length), a.aiDisplay = a.aiDisplayMaster.slice();
                else if (a.aiDisplay.length == a.aiDisplayMaster.length || f.sSearch.length > b.length || 1 == c || 0 !== b.indexOf(f.sSearch)) {
                    a.aiDisplay.splice(0, a.aiDisplay.length);
                    ja(a, 1);
                    for (b = 0; b < a.aiDisplayMaster.length; b++) d.test(a.asDataSearch[b]) && a.aiDisplay.push(a.aiDisplayMaster[b])
                } else for (b = c = 0; b < a.asDataSearch.length; b++) d.test(a.asDataSearch[b]) || (a.aiDisplay.splice(b - c, 1), c++)
            }
            function ja(a, b) {
                if (!a.oFeatures.bServerSide) {
                    a.asDataSearch.splice(0, a.asDataSearch.length);
                    for (var c = b && 1 === b ? a.aiDisplayMaster : a.aiDisplay, d = 0, f = c.length; d < f; d++) a.asDataSearch[d] = ma(a, X(a, c[d], "filter"))
                }
            }
            function ma(a, b) {
                var c = "";
                if (a.__nTmpFilter === m) a.__nTmpFilter = l.createElement("div");
                for (var d = a.__nTmpFilter, f = 0, g = a.aoColumns.length; f < g; f++) a.aoColumns[f].bSearchable && (c += la(b[f], a.aoColumns[f].sType) + "  ");
                if (-1 !== c.indexOf("&")) d.innerHTML = c, c = d.textContent ? d.textContent : d.innerText, c = c.replace(/\n/g, " ").replace(/\r/g, "");
                return c
            }
            function ka(a, b, c, d) {
                if (c) return a = b ? a.split(" ") : na(a).split(" "), a = "^(?=.*?" + a.join(")(?=.*?") + ").*$", RegExp(a, d ? "i" : "");
                a = b ? a : na(a);
                return RegExp(a, d ? "i" : "")
            }
            function la(a, b) {
                return "function" === typeof j.ext.ofnSearch[b] ? j.ext.ofnSearch[b](a) : null === a ? "" : "html" == b ? a.replace(/[\r\n]/g, " ").replace(/<.*?>/g, "") : "string" === typeof a ? a.replace(/[\r\n]/g, " ") : a
            }
            function na(a) {
                return a.replace(RegExp("(\\/|\\.|\\*|\\+|\\?|\\||\\(|\\)|\\[|\\]|\\{|\\}|\\\\|\\$|\\^)", "g"), "\\$1")
            }
            function Ca(a) {
                var b = l.createElement("div");
                b.className = a.oClasses.sInfo;
                if (!a.aanFeatures.i) a.aoDrawCallback.push({
                    fn: Ja,
                    sName: "information"
                }), b.id = a.sTableId + "_info";
                a.nTable.setAttribute("aria-describedby", a.sTableId + "_info");
                return b
            }
            function Ja(a) {
                if (a.oFeatures.bInfo && 0 !== a.aanFeatures.i.length) {
                    var b = a.oLanguage,
                        c = a._iDisplayStart + 1,
                        d = a.fnDisplayEnd(),
                        f = a.fnRecordsTotal(),
                        g = a.fnRecordsDisplay(),
                        i;
                    i = 0 === g && g == f ? b.sInfoEmpty : 0 === g ? b.sInfoEmpty + " " + b.sInfoFiltered : g == f ? b.sInfo : b.sInfo + " " + b.sInfoFiltered;
                    i += b.sInfoPostFix;
                    i = ha(a, i);
                    null !== b.fnInfoCallback && (i = b.fnInfoCallback.call(a.oInstance, a, c, d, f, g, i));
                    a = a.aanFeatures.i;
                    b = 0;
                    for (c = a.length; b < c; b++) h(a[b]).html(i)
                }
            }
            function ha(a, b) {
                var c = a.fnFormatNumber(a._iDisplayStart + 1),
                    d = a.fnDisplayEnd(),
                    d = a.fnFormatNumber(d),
                    f = a.fnRecordsDisplay(),
                    f = a.fnFormatNumber(f),
                    g = a.fnRecordsTotal(),
                    g = a.fnFormatNumber(g);
                a.oScroll.bInfinite && (c = a.fnFormatNumber(1));
                return b.replace("_START_", c).replace("_END_", d).replace("_TOTAL_", f).replace("_MAX_", g)
            }
            function aa(a) {
                var b, c, d = a.iInitDisplayStart;
                if (!1 === a.bInitialised) setTimeout(function () {
                    aa(a)
                }, 200);
                else {
                    xa(a);
                    va(a);
                    U(a, a.aoHeader);
                    a.nTFoot && U(a, a.aoFooter);
                    G(a, !0);
                    a.oFeatures.bAutoWidth && ba(a);
                    for (b = 0, c = a.aoColumns.length; b < c; b++) if (null !== a.aoColumns[b].sWidth) a.aoColumns[b].nTh.style.width = q(a.aoColumns[b].sWidth);
                    a.oFeatures.bSort ? P(a) : a.oFeatures.bFilter ? M(a, a.oPreviousSearch) : (a.aiDisplay = a.aiDisplayMaster.slice(), B(a), z(a));
                    null !== a.sAjaxSource && !a.oFeatures.bServerSide ? (c = [], ia(a, c), a.fnServerData.call(a.oInstance, a.sAjaxSource, c, function (c) {
                        var g = "" !== a.sAjaxDataProp ? W(a.sAjaxDataProp)(c) : c;
                        for (b = 0; b < g.length; b++) H(a, g[b]);
                        a.iInitDisplayStart = d;
                        a.oFeatures.bSort ? P(a) : (a.aiDisplay = a.aiDisplayMaster.slice(), B(a), z(a));
                        G(a, !1);
                        Z(a, c)
                    }, a)) : a.oFeatures.bServerSide || (G(a, !1), Z(a))
                }
            }
            function Z(a, b) {
                a._bInitComplete = !0;
                D(a, "aoInitComplete", "init", [a, b])
            }
            function oa(a) {
                var b = j.defaults.oLanguage;
                !a.sEmptyTable && a.sZeroRecords && "No data available in table" === b.sEmptyTable && p(a, a, "sZeroRecords", "sEmptyTable");
                !a.sLoadingRecords && a.sZeroRecords && "Loading..." === b.sLoadingRecords && p(a, a, "sZeroRecords", "sLoadingRecords")
            }
            function ya(a) {
                if (a.oScroll.bInfinite) return null;
                var b = '<select size="1" ' + ('name="' + a.sTableId + '_length"') + ">",
                    c, d, f = a.aLengthMenu;
                if (2 == f.length && "object" === typeof f[0] && "object" === typeof f[1]) for (c = 0, d = f[0].length; c < d; c++) b += '<option value="' + f[0][c] + '">' + f[1][c] + "</option>";
                else for (c = 0, d = f.length; c < d; c++) b += '<option value="' + f[c] + '">' + f[c] + "</option>";
                b += "</select>";
                f = l.createElement("div");
                if (!a.aanFeatures.l) f.id = a.sTableId + "_length";
                f.className = a.oClasses.sLength;
                f.innerHTML = "<label>" + a.oLanguage.sLengthMenu.replace("_MENU_", b) + "</label>";
                h('select option[value="' + a._iDisplayLength + '"]', f).attr("selected", !0);
                h("select", f).bind("change.DT", function () {
                    var b = h(this).val(),
                        f = a.aanFeatures.l;
                    for (c = 0, d = f.length; c < d; c++) f[c] != this.parentNode && h("select", f[c]).val(b);
                    a._iDisplayLength = parseInt(b, 10);
                    B(a);
                    if (a.fnDisplayEnd() == a.fnRecordsDisplay() && (a._iDisplayStart = a.fnDisplayEnd() - a._iDisplayLength, 0 > a._iDisplayStart)) a._iDisplayStart = 0;
                    if (-1 == a._iDisplayLength) a._iDisplayStart = 0;
                    z(a)
                });
                h("select", f).attr("aria-controls", a.sTableId);
                return f
            }
            function B(a) {
                a._iDisplayEnd = !1 === a.oFeatures.bPaginate ? a.aiDisplay.length : a._iDisplayStart + a._iDisplayLength > a.aiDisplay.length || -1 == a._iDisplayLength ? a.aiDisplay.length : a._iDisplayStart + a._iDisplayLength
            }

            function Da(a) {
                if (a.oScroll.bInfinite) return null;
                var b = l.createElement("div");
                b.className = a.oClasses.sPaging + a.sPaginationType;
                j.ext.oPagination[a.sPaginationType].fnInit(a, b, function (a) {
                    B(a);
                    z(a)
                });
                a.aanFeatures.p || a.aoDrawCallback.push({
                    fn: function (a) {
                        j.ext.oPagination[a.sPaginationType].fnUpdate(a, function (a) {
                            B(a);
                            z(a)
                        })
                    },
                    sName: "pagination"
                });
                return b
            }
            function pa(a, b) {
                var c = a._iDisplayStart;
                if ("number" === typeof b) {
                    if (a._iDisplayStart = b * a._iDisplayLength, a._iDisplayStart > a.fnRecordsDisplay()) a._iDisplayStart = 0
                } else if ("first" == b) a._iDisplayStart = 0;
                else if ("previous" == b) {
                    if (a._iDisplayStart = 0 <= a._iDisplayLength ? a._iDisplayStart - a._iDisplayLength : 0, 0 > a._iDisplayStart) a._iDisplayStart = 0
                } else if ("next" == b) 0 <= a._iDisplayLength ? a._iDisplayStart + a._iDisplayLength < a.fnRecordsDisplay() && (a._iDisplayStart += a._iDisplayLength) : a._iDisplayStart = 0;
                else if ("last" == b) if (0 <= a._iDisplayLength) {
                    var d = parseInt((a.fnRecordsDisplay() - 1) / a._iDisplayLength, 10) + 1;
                    a._iDisplayStart = (d - 1) * a._iDisplayLength
                } else a._iDisplayStart = 0;
                else F(a, 0, "Unknown paging action: " + b);
                h(a.oInstance).trigger("page", a);
                return c != a._iDisplayStart
            }
            function Aa(a) {
                var b = l.createElement("div");
                if (!a.aanFeatures.r) b.id = a.sTableId + "_processing";
                b.innerHTML = a.oLanguage.sProcessing;
                b.className = a.oClasses.sProcessing;
                a.nTable.parentNode.insertBefore(b, a.nTable);
                return b
            }
            function G(a, b) {
                if (a.oFeatures.bProcessing) for (var c = a.aanFeatures.r, d = 0, f = c.length; d < f; d++) c[d].style.visibility = b ? "visible" : "hidden";
                h(a.oInstance).trigger("processing", [a, b])
            }
            function Ba(a) {
                if ("" === a.oScroll.sX && "" === a.oScroll.sY) return a.nTable;
                var b = l.createElement("div"),
                    c = l.createElement("div"),
                    d = l.createElement("div"),
                    f = l.createElement("div"),
                    g = l.createElement("div"),
                    i = l.createElement("div"),
                    e = a.nTable.cloneNode(!1),
                    j = a.nTable.cloneNode(!1),
                    n = a.nTable.getElementsByTagName("thead")[0],
                    o = 0 === a.nTable.getElementsByTagName("tfoot").length ? null : a.nTable.getElementsByTagName("tfoot")[0],
                    k = a.oClasses;
                c.appendChild(d);
                g.appendChild(i);
                f.appendChild(a.nTable);
                b.appendChild(c);
                b.appendChild(f);
                d.appendChild(e);
                e.appendChild(n);
                null !== o && (b.appendChild(g), i.appendChild(j), j.appendChild(o));
                b.className = k.sScrollWrapper;
                c.className = k.sScrollHead;
                d.className = k.sScrollHeadInner;
                f.className = k.sScrollBody;
                g.className = k.sScrollFoot;
                i.className = k.sScrollFootInner;
                if (a.oScroll.bAutoCss) c.style.overflow = "hidden", c.style.position = "relative", g.style.overflow = "hidden", f.style.overflow = "auto";
                c.style.border = "0";
                c.style.width = "100%";
                g.style.border = "0";
                d.style.width = "" !== a.oScroll.sXInner ? a.oScroll.sXInner : "100%";
                e.removeAttribute("id");
                e.style.marginLeft = "0";
                a.nTable.style.marginLeft = "0";
                if (null !== o) j.removeAttribute("id"), j.style.marginLeft = "0";
                d = h(a.nTable).children("caption");
                0 < d.length && (d = d[0], "top" === d._captionSide ? e.appendChild(d) : "bottom" === d._captionSide && o && j.appendChild(d));
                if ("" !== a.oScroll.sX) {
                    c.style.width = q(a.oScroll.sX);
                    f.style.width = q(a.oScroll.sX);
                    if (null !== o) g.style.width = q(a.oScroll.sX);
                    h(f).scroll(function () {
                        c.scrollLeft = this.scrollLeft;
                        if (null !== o) g.scrollLeft = this.scrollLeft
                    })
                }
                if ("" !== a.oScroll.sY) f.style.height = q(a.oScroll.sY);
                a.aoDrawCallback.push({
                    fn: Ka,
                    sName: "scrolling"
                });
                a.oScroll.bInfinite && h(f).scroll(function () {
                    !a.bDrawing && 0 !== h(this).scrollTop() && h(this).scrollTop() + h(this).height() > h(a.nTable).height() - a.oScroll.iLoadGap && a.fnDisplayEnd() < a.fnRecordsDisplay() && (pa(a, "next"), B(a), z(a))
                });
                a.nScrollHead = c;
                a.nScrollFoot = g;
                return b
            }
            function Ka(a) {
                var b = a.nScrollHead.getElementsByTagName("div")[0],
                    c = b.getElementsByTagName("table")[0],
                    d = a.nTable.parentNode,
                    f, g, i, e, j, n, o, k, m = [],
                    s = null !== a.nTFoot ? a.nScrollFoot.getElementsByTagName("div")[0] : null,
                    p = null !== a.nTFoot ? s.getElementsByTagName("table")[0] : null,
                    l = h.browser.msie && 7 >= h.browser.version;
                h(a.nTable).children("thead, tfoot").remove();
                i = h(a.nTHead).clone()[0];
                a.nTable.insertBefore(i, a.nTable.childNodes[0]);
                null !== a.nTFoot && (j = h(a.nTFoot).clone()[0], a.nTable.insertBefore(j, a.nTable.childNodes[1]));
                if ("" === a.oScroll.sX) d.style.width = "100%", b.parentNode.style.width = "100%";
                var r = O(a, i);
                for (f = 0, g = r.length; f < g; f++) o = x(a, f), r[f].style.width = a.aoColumns[o].sWidth;
                null !== a.nTFoot && N(function (a) {
                    a.style.width = ""
                }, j.getElementsByTagName("tr"));
                if (a.oScroll.bCollapse && "" !== a.oScroll.sY) d.style.height = d.offsetHeight + a.nTHead.offsetHeight + "px";
                f = h(a.nTable).outerWidth();
                if ("" === a.oScroll.sX) {
                    if (a.nTable.style.width = "100%", l && (h("tbody", d).height() > d.offsetHeight || "scroll" == h(d).css("overflow-y"))) a.nTable.style.width = q(h(a.nTable).outerWidth() - a.oScroll.iBarWidth)
                } else if ("" !== a.oScroll.sXInner) a.nTable.style.width = q(a.oScroll.sXInner);
                else if (f == h(d).width() && h(d).height() < h(a.nTable).height()) {
                    if (a.nTable.style.width = q(f - a.oScroll.iBarWidth), h(a.nTable).outerWidth() > f - a.oScroll.iBarWidth) a.nTable.style.width = q(f)
                } else a.nTable.style.width = q(f);
                f = h(a.nTable).outerWidth();
                g = a.nTHead.getElementsByTagName("tr");
                i = i.getElementsByTagName("tr");
                N(function (a, b) {
                    n = a.style;
                    n.paddingTop = "0";
                    n.paddingBottom = "0";
                    n.borderTopWidth = "0";
                    n.borderBottomWidth = "0";
                    n.height = 0;
                    k = h(a).width();
                    b.style.width = q(k);
                    m.push(k)
                }, i, g);
                h(i).height(0);
                null !== a.nTFoot && (e = j.getElementsByTagName("tr"), j = a.nTFoot.getElementsByTagName("tr"), N(function (a, b) {
                    n = a.style;
                    n.paddingTop = "0";
                    n.paddingBottom = "0";
                    n.borderTopWidth = "0";
                    n.borderBottomWidth = "0";
                    n.height = 0;
                    k = h(a).width();
                    b.style.width = q(k);
                    m.push(k)
                }, e, j), h(e).height(0));
                N(function (a) {
                    a.innerHTML = "";
                    a.style.width = q(m.shift())
                }, i);
                null !== a.nTFoot && N(function (a) {
                    a.innerHTML = "";
                    a.style.width = q(m.shift())
                }, e);
                if (h(a.nTable).outerWidth() < f) {
                    e = d.scrollHeight > d.offsetHeight || "scroll" == h(d).css("overflow-y") ? f + a.oScroll.iBarWidth : f;
                    if (l && (d.scrollHeight > d.offsetHeight || "scroll" == h(d).css("overflow-y"))) a.nTable.style.width = q(e - a.oScroll.iBarWidth);
                    d.style.width = q(e);
                    b.parentNode.style.width = q(e);
                    if (null !== a.nTFoot) s.parentNode.style.width = q(e);
                    "" === a.oScroll.sX ? F(a, 1, "The table cannot fit into the current element which will cause column misalignment. The table has been drawn at its minimum possible width.") : "" !== a.oScroll.sXInner && F(a, 1, "The table cannot fit into the current element which will cause column misalignment. Increase the sScrollXInner value or remove it to allow automatic calculation")
                } else if (d.style.width = q("100%"), b.parentNode.style.width = q("100%"), null !== a.nTFoot) s.parentNode.style.width = q("100%");
                if ("" === a.oScroll.sY && l) d.style.height = q(a.nTable.offsetHeight + a.oScroll.iBarWidth);
                if ("" !== a.oScroll.sY && a.oScroll.bCollapse && (d.style.height = q(a.oScroll.sY), l = "" !== a.oScroll.sX && a.nTable.offsetWidth > d.offsetWidth ? a.oScroll.iBarWidth : 0, a.nTable.offsetHeight < d.offsetHeight)) d.style.height = q(a.nTable.offsetHeight + l);
                l = h(a.nTable).outerWidth();
                c.style.width = q(l);
                b.style.width = q(l);
                c = h(a.nTable).height() > d.clientHeight || "scroll" == h(d).css("overflow-y");
                b.style.paddingRight = c ? a.oScroll.iBarWidth + "px" : "0px";
                if (null !== a.nTFoot) p.style.width = q(l), s.style.width = q(l), s.style.paddingRight = c ? a.oScroll.iBarWidth + "px" : "0px";
                h(d).scroll();
                if (a.bSorted || a.bFiltered) d.scrollTop = 0
            }
            function N(a, b, c) {
                for (var d = 0, f = b.length; d < f; d++) for (var g = 0, i = b[d].childNodes.length; g < i; g++) 1 == b[d].childNodes[g].nodeType && (c ? a(b[d].childNodes[g], c[d].childNodes[g]) : a(b[d].childNodes[g]))
            }
            function La(a, b) {
                if (!a || null === a || "" === a) return 0;
                b || (b = l.getElementsByTagName("body")[0]);
                var c, d = l.createElement("div");
                d.style.width = q(a);
                b.appendChild(d);
                c = d.offsetWidth;
                b.removeChild(d);
                return c
            }
            function ba(a) {
                var b = 0,
                    c, d = 0,
                    f = a.aoColumns.length,
                    g, i = h("th", a.nTHead),
                    e = a.nTable.getAttribute("width");
                for (g = 0; g < f; g++) if (a.aoColumns[g].bVisible && (d++, null !== a.aoColumns[g].sWidth)) {
                    c = La(a.aoColumns[g].sWidthOrig, a.nTable.parentNode);
                    if (null !== c) a.aoColumns[g].sWidth = q(c);
                    b++
                }
                if (f == i.length && 0 === b && d == f && "" === a.oScroll.sX && "" === a.oScroll.sY) for (g = 0; g < a.aoColumns.length; g++) {
                    if (c = h(i[g]).width(), null !== c) a.aoColumns[g].sWidth = q(c)
                } else {
                    b = a.nTable.cloneNode(!1);
                    g = a.nTHead.cloneNode(!0);
                    d = l.createElement("tbody");
                    c = l.createElement("tr");
                    b.removeAttribute("id");
                    b.appendChild(g);
                    null !== a.nTFoot && (b.appendChild(a.nTFoot.cloneNode(!0)), N(function (a) {
                        a.style.width = ""
                    }, b.getElementsByTagName("tr")));
                    b.appendChild(d);
                    d.appendChild(c);
                    d = h("thead th", b);
                    0 === d.length && (d = h("tbody tr:eq(0)>td", b));
                    i = O(a, g);
                    for (g = d = 0; g < f; g++) {
                        var j = a.aoColumns[g];
                        j.bVisible && null !== j.sWidthOrig && "" !== j.sWidthOrig ? i[g - d].style.width = q(j.sWidthOrig) : j.bVisible ? i[g - d].style.width = "" : d++
                    }
                    for (g = 0; g < f; g++) a.aoColumns[g].bVisible && (d = Ma(a, g), null !== d && (d = d.cloneNode(!0), "" !== a.aoColumns[g].sContentPadding && (d.innerHTML += a.aoColumns[g].sContentPadding), c.appendChild(d)));
                    f = a.nTable.parentNode;
                    f.appendChild(b);
                    if ("" !== a.oScroll.sX && "" !== a.oScroll.sXInner) b.style.width = q(a.oScroll.sXInner);
                    else if ("" !== a.oScroll.sX) {
                        if (b.style.width = "", h(b).width() < f.offsetWidth) b.style.width = q(f.offsetWidth)
                    } else if ("" !== a.oScroll.sY) b.style.width = q(f.offsetWidth);
                    else if (e) b.style.width = q(e);
                    b.style.visibility = "hidden";
                    Na(a, b);
                    f = h("tbody tr:eq(0)", b).children();
                    0 === f.length && (f = O(a, h("thead", b)[0]));
                    if ("" !== a.oScroll.sX) {
                        for (g = d = c = 0; g < a.aoColumns.length; g++) a.aoColumns[g].bVisible && (c = null === a.aoColumns[g].sWidthOrig ? c + h(f[d]).outerWidth() : c + (parseInt(a.aoColumns[g].sWidth.replace("px", ""), 10) + (h(f[d]).outerWidth() - h(f[d]).width())), d++);
                        b.style.width = q(c);
                        a.nTable.style.width = q(c)
                    }
                    for (g = d = 0; g < a.aoColumns.length; g++) if (a.aoColumns[g].bVisible) {
                        c = h(f[d]).width();
                        if (null !== c && 0 < c) a.aoColumns[g].sWidth = q(c);
                        d++
                    }
                    f = h(b).css("width");
                    a.nTable.style.width = -1 !== f.indexOf("%") ? f : q(h(b).outerWidth());
                    b.parentNode.removeChild(b)
                }
                if (e) a.nTable.style.width = q(e)
            }
            function Na(a, b) {
                if ("" === a.oScroll.sX && "" !== a.oScroll.sY) h(b).width(), b.style.width = q(h(b).outerWidth() - a.oScroll.iBarWidth);
                else if ("" !== a.oScroll.sX) b.style.width = q(h(b).outerWidth())
            }
            function Ma(a, b) {
                var c = Oa(a, b);
                if (0 > c) return null;
                if (null === a.aoData[c].nTr) {
                    var d = l.createElement("td");
                    d.innerHTML = w(a, c, b, "");
                    return d
                }
                return L(a, c)[b]
            }
            function Oa(a, b) {
                for (var c = -1, d = -1, f = 0; f < a.aoData.length; f++) {
                    var g = w(a, f, b, "display") + "",
                        g = g.replace(/<.*?>/g, "");
                    if (g.length > c) c = g.length, d = f
                }
                return d
            }
            function q(a) {
                if (null === a) return "0px";
                if ("number" == typeof a) return 0 > a ? "0px" : a + "px";
                var b = a.charCodeAt(a.length - 1);
                return 48 > b || 57 < b ? a : a + "px"
            }
            function Pa() {
                var a = l.createElement("p"),
                    b = a.style;
                b.width = "100%";
                b.height = "200px";
                b.padding = "0px";
                var c = l.createElement("div"),
                    b = c.style;
                b.position = "absolute";
                b.top = "0px";
                b.left = "0px";
                b.visibility = "hidden";
                b.width = "200px";
                b.height = "150px";
                b.padding = "0px";
                b.overflow = "hidden";
                c.appendChild(a);
                l.body.appendChild(c);
                b = a.offsetWidth;
                c.style.overflow = "scroll";
                a = a.offsetWidth;
                if (b == a) a = c.clientWidth;
                l.body.removeChild(c);
                return b - a
            }
            function P(a, b) {
                var c, d, f, g, i, e, o = [],
                    n = [],
                    k = j.ext.oSort,
                    s = a.aoData,
                    l = a.aoColumns,
                    p = a.oLanguage.oAria;
                if (!a.oFeatures.bServerSide && (0 !== a.aaSorting.length || null !== a.aaSortingFixed)) {
                    o = null !== a.aaSortingFixed ? a.aaSortingFixed.concat(a.aaSorting) : a.aaSorting.slice();
                    for (c = 0; c < o.length; c++) if (d = o[c][0], f = r(a, d), g = a.aoColumns[d].sSortDataType, j.ext.afnSortData[g]) if (i = j.ext.afnSortData[g].call(a.oInstance, a, d, f), i.length === s.length) for (f = 0, g = s.length; f < g; f++) I(a, f, d, i[f]);
                    else F(a, 0, "Returned data sort array (col " + d + ") is the wrong length");
                    for (c = 0, d = a.aiDisplayMaster.length; c < d; c++) n[a.aiDisplayMaster[c]] = c;
                    var q = o.length,
                        x;
                    for (c = 0, d = s.length; c < d; c++) for (f = 0; f < q; f++) {
                        x = l[o[f][0]].aDataSort;
                        for (i = 0, e = x.length; i < e; i++) g = l[x[i]].sType, g = k[(g ? g : "string") + "-pre"], s[c]._aSortData[x[i]] = g ? g(w(a, c, x[i], "sort")) : w(a, c, x[i], "sort")
                    }
                    a.aiDisplayMaster.sort(function (a, b) {
                        var c, d, f, g, i;
                        for (c = 0; c < q; c++) {
                            i = l[o[c][0]].aDataSort;
                            for (d = 0, f = i.length; d < f; d++) if (g = l[i[d]].sType, g = k[(g ? g : "string") + "-" + o[c][1]](s[a]._aSortData[i[d]], s[b]._aSortData[i[d]]), 0 !== g) return g
                        }
                        return k["numeric-asc"](n[a], n[b])
                    })
                }(b === m || b) && !a.oFeatures.bDeferRender && Q(a);
                for (c = 0, d = a.aoColumns.length; c < d; c++) g = l[c].sTitle.replace(/<.*?>/g, ""), f = l[c].nTh, f.removeAttribute("aria-sort"), f.removeAttribute("aria-label"), l[c].bSortable ? 0 < o.length && o[0][0] == c ? (f.setAttribute("aria-sort", "asc" == o[0][1] ? "ascending" : "descending"), f.setAttribute("aria-label", g + ("asc" == (l[c].asSorting[o[0][2] + 1] ? l[c].asSorting[o[0][2] + 1] : l[c].asSorting[0]) ? p.sSortAscending : p.sSortDescending))) : f.setAttribute("aria-label", g + ("asc" == l[c].asSorting[0] ? p.sSortAscending : p.sSortDescending)) : f.setAttribute("aria-label", g);
                a.bSorted = !0;
                h(a.oInstance).trigger("sort", a);
                a.oFeatures.bFilter ? M(a, a.oPreviousSearch, 1) : (a.aiDisplay = a.aiDisplayMaster.slice(), a._iDisplayStart = 0, B(a), z(a))
            }
            function ga(a, b, c, d) {
                Qa(b, {}, function (b) {
                    if (!1 !== a.aoColumns[c].bSortable) {
                        var g = function () {
                                var d, g;
                                if (b.shiftKey) {
                                    for (var e = !1, h = 0; h < a.aaSorting.length; h++) if (a.aaSorting[h][0] == c) {
                                        e = !0;
                                        d = a.aaSorting[h][0];
                                        g = a.aaSorting[h][2] + 1;
                                        a.aoColumns[d].asSorting[g] ? (a.aaSorting[h][1] = a.aoColumns[d].asSorting[g], a.aaSorting[h][2] = g) : a.aaSorting.splice(h, 1);
                                        break
                                    }!1 === e && a.aaSorting.push([c, a.aoColumns[c].asSorting[0], 0])
                                } else 1 == a.aaSorting.length && a.aaSorting[0][0] == c ? (d = a.aaSorting[0][0], g = a.aaSorting[0][2] + 1, a.aoColumns[d].asSorting[g] || (g = 0), a.aaSorting[0][1] = a.aoColumns[d].asSorting[g], a.aaSorting[0][2] = g) : (a.aaSorting.splice(0, a.aaSorting.length), a.aaSorting.push([c, a.aoColumns[c].asSorting[0], 0]));
                                P(a)
                            };
                        a.oFeatures.bProcessing ? (G(a, !0), setTimeout(function () {
                            g();
                            a.oFeatures.bServerSide || G(a, !1)
                        }, 0)) : g();
                        "function" == typeof d && d(a)
                    }
                })
            }
            function Q(a) {
                var b, c, d, f, g, e = a.aoColumns.length,
                    j = a.oClasses;
                for (b = 0; b < e; b++) a.aoColumns[b].bSortable && h(a.aoColumns[b].nTh).removeClass(j.sSortAsc + " " + j.sSortDesc + " " + a.aoColumns[b].sSortingClass);
                f = null !== a.aaSortingFixed ? a.aaSortingFixed.concat(a.aaSorting) : a.aaSorting.slice();
                for (b = 0; b < a.aoColumns.length; b++) if (a.aoColumns[b].bSortable) {
                    g = a.aoColumns[b].sSortingClass;
                    d = -1;
                    for (c = 0; c < f.length; c++) if (f[c][0] == b) {
                        g = "asc" == f[c][1] ? j.sSortAsc : j.sSortDesc;
                        d = c;
                        break
                    }
                    h(a.aoColumns[b].nTh).addClass(g);
                    a.bJUI && (c = h("span." + j.sSortIcon, a.aoColumns[b].nTh), c.removeClass(j.sSortJUIAsc + " " + j.sSortJUIDesc + " " + j.sSortJUI + " " + j.sSortJUIAscAllowed + " " + j.sSortJUIDescAllowed), c.addClass(-1 == d ? a.aoColumns[b].sSortingClassJUI : "asc" == f[d][1] ? j.sSortJUIAsc : j.sSortJUIDesc))
                } else h(a.aoColumns[b].nTh).addClass(a.aoColumns[b].sSortingClass);
                g = j.sSortColumn;
                if (a.oFeatures.bSort && a.oFeatures.bSortClasses) {
                    d = L(a);
                    if (a.oFeatures.bDeferRender) h(d).removeClass(g + "1 " + g + "2 " + g + "3");
                    else if (d.length >= e) for (b = 0; b < e; b++) if (-1 != d[b].className.indexOf(g + "1")) for (c = 0, a = d.length / e; c < a; c++) d[e * c + b].className = h.trim(d[e * c + b].className.replace(g + "1", ""));
                    else if (-1 != d[b].className.indexOf(g + "2")) for (c = 0, a = d.length / e; c < a; c++) d[e * c + b].className = h.trim(d[e * c + b].className.replace(g + "2", ""));
                    else if (-1 != d[b].className.indexOf(g + "3")) for (c = 0, a = d.length / e; c < a; c++) d[e * c + b].className = h.trim(d[e * c + b].className.replace(" " + g + "3", ""));
                    var j = 1,
                        o;
                    for (b = 0; b < f.length; b++) {
                        o = parseInt(f[b][0], 10);
                        for (c = 0, a = d.length / e; c < a; c++) d[e * c + o].className += " " + g + j;
                        3 > j && j++
                    }
                }
            }
            function qa(a) {
                if (a.oFeatures.bStateSave && !a.bDestroying) {
                    var b, c;
                    b = a.oScroll.bInfinite;
                    var d = {
                        iCreate: (new Date).getTime(),
                        iStart: b ? 0 : a._iDisplayStart,
                        iEnd: b ? a._iDisplayLength : a._iDisplayEnd,
                        iLength: a._iDisplayLength,
                        aaSorting: h.extend(!0, [], a.aaSorting),
                        oSearch: h.extend(!0, {}, a.oPreviousSearch),
                        aoSearchCols: h.extend(!0, [], a.aoPreSearchCols),
                        abVisCols: []
                    };
                    for (b = 0, c = a.aoColumns.length; b < c; b++) d.abVisCols.push(a.aoColumns[b].bVisible);
                    D(a, "aoStateSaveParams", "stateSaveParams", [a, d]);
                    a.fnStateSave.call(a.oInstance, a, d)
                }
            }
            function Ra(a, b) {
                if (a.oFeatures.bStateSave) {
                    var c = a.fnStateLoad.call(a.oInstance, a);
                    if (c) {
                        var d = D(a, "aoStateLoadParams", "stateLoadParams", [a, c]);
                        if (-1 === h.inArray(!1, d)) {
                            a.oLoadedState = h.extend(!0, {}, c);
                            a._iDisplayStart = c.iStart;
                            a.iInitDisplayStart = c.iStart;
                            a._iDisplayEnd = c.iEnd;
                            a._iDisplayLength = c.iLength;
                            a.aaSorting = c.aaSorting.slice();
                            a.saved_aaSorting = c.aaSorting.slice();
                            h.extend(a.oPreviousSearch, c.oSearch);
                            h.extend(!0, a.aoPreSearchCols, c.aoSearchCols);
                            b.saved_aoColumns = [];
                            for (d = 0; d < c.abVisCols.length; d++) b.saved_aoColumns[d] = {}, b.saved_aoColumns[d].bVisible = c.abVisCols[d];
                            D(a, "aoStateLoaded", "stateLoaded", [a, c])
                        }
                    }
                }
            }
            function Sa(a) {
                for (var b = V.location.pathname.split("/"), a = a + "_" + b[b.length - 1].replace(/[\/:]/g, "").toLowerCase() + "=", b = l.cookie.split(";"), c = 0; c < b.length; c++) {
                    for (var d = b[c];
                    " " == d.charAt(0);) d = d.substring(1, d.length);
                    if (0 === d.indexOf(a)) return decodeURIComponent(d.substring(a.length, d.length))
                }
                return null
            }
            function t(a) {
                for (var b = 0; b < j.settings.length; b++) if (j.settings[b].nTable === a) return j.settings[b];
                return null
            }
            function S(a) {
                for (var b = [], a = a.aoData, c = 0, d = a.length; c < d; c++) null !== a[c].nTr && b.push(a[c].nTr);
                return b
            }
            function L(a, b) {
                var c = [],
                    d, f, g, e, h, j;
                f = 0;
                var o = a.aoData.length;
                b !== m && (f = b, o = b + 1);
                for (g = f; g < o; g++) if (j = a.aoData[g], null !== j.nTr) {
                    f = [];
                    for (e = 0, h = j.nTr.childNodes.length; e < h; e++) d = j.nTr.childNodes[e].nodeName.toLowerCase(), ("td" == d || "th" == d) && f.push(j.nTr.childNodes[e]);
                    d = 0;
                    for (e = 0, h = a.aoColumns.length; e < h; e++) a.aoColumns[e].bVisible ? c.push(f[e - d]) : (c.push(j._anHidden[e]), d++)
                }
                return c
            }
            function F(a, b, c) {
                a = null === a ? "DataTables warning: " + c : "DataTables warning (table id = '" + a.sTableId + "'): " + c;
                if (0 === b) if ("alert" == j.ext.sErrMode) alert(a);
                else throw Error(a);
                else V.console && console.log && console.log(a)
            }
            function p(a, b, c, d) {
                d === m && (d = c);
                b[c] !== m && (a[d] = b[c])
            }
            function Ta(a, b) {
                for (var c in b) b.hasOwnProperty(c) && ("object" === typeof e[c] && !1 === h.isArray(b[c]) ? h.extend(!0, a[c], b[c]) : a[c] = b[c]);
                return a
            }
            function Qa(a, b, c) {
                h(a).bind("click.DT", b, function (b) {
                    a.blur();
                    c(b)
                }).bind("keypress.DT", b, function (a) {
                    13 === a.which && c(a)
                }).bind("selectstart.DT", function () {
                    return !1
                })
            }
            function C(a, b, c, d) {
                c && a[b].push({
                    fn: c,
                    sName: d
                })
            }
            function D(a, b, c, d) {
                for (var b = a[b], f = [], g = b.length - 1; 0 <= g; g--) f.push(b[g].fn.apply(a.oInstance, d));
                null !== c && h(a.oInstance).trigger(c, d);
                return f
            }
            function Ua(a) {
                return function () {
                    var b = [t(this[j.ext.iApiIndex])].concat(Array.prototype.slice.call(arguments));
                    return j.ext.oApi[a].apply(this, b)
                }
            }
            var Va = V.JSON ? JSON.stringify : function (a) {
                    var b = typeof a;
                    if ("object" !== b || null === a) return "string" === b && (a = '"' + a + '"'), a + "";
                    var c, d, f = [],
                        g = h.isArray(a);
                    for (c in a) d = a[c], b = typeof d, "string" === b ? d = '"' + d + '"' : "object" === b && null !== d && (d = Va(d)), f.push((g ? "" : '"' + c + '":') + d);
                    return (g ? "[" : "{") + f + (g ? "]" : "}")
                };
            this.$ = function (a, b) {
                var c, d, f = [],
                    g = t(this[j.ext.iApiIndex]);
                b || (b = {});
                b = h.extend({}, {
                    filter: "none",
                    order: "current",
                    page: "all"
                }, b);
                if ("current" == b.page) for (c = g._iDisplayStart, d = g.fnDisplayEnd(); c < d; c++) f.push(g.aoData[g.aiDisplay[c]].nTr);
                else if ("current" == b.order && "none" == b.filter) for (c = 0, d = g.aiDisplayMaster.length; c < d; c++) f.push(g.aoData[g.aiDisplayMaster[c]].nTr);
                else if ("current" == b.order && "applied" == b.filter) for (c = 0, d = g.aiDisplay.length; c < d; c++) f.push(g.aoData[g.aiDisplay[c]].nTr);
                else if ("original" == b.order && "none" == b.filter) for (c = 0, d = g.aoData.length; c < d; c++) f.push(g.aoData[c].nTr);
                else if ("original" == b.order && "applied" == b.filter) for (c = 0, d = g.aoData.length; c < d; c++) - 1 !== h.inArray(c, g.aiDisplay) && f.push(g.aoData[c].nTr);
                else F(g, 1, "Unknown selection options");
                d = h(f);
                c = d.filter(a);
                d = d.find(a);
                return h([].concat(h.makeArray(c), h.makeArray(d)))
            };
            this._ = function (a, b) {
                var c = [],
                    d, f, g = this.$(a, b);
                for (d = 0, f = g.length; d < f; d++) c.push(this.fnGetData(g[d]));
                return c
            };
            this.fnAddData = function (a, b) {
                if (0 === a.length) return [];
                var c = [],
                    d, f = t(this[j.ext.iApiIndex]);
                if ("object" === typeof a[0] && null !== a[0]) for (var g = 0; g < a.length; g++) {
                    d = H(f, a[g]);
                    if (-1 == d) return c;
                    c.push(d)
                } else {
                    d = H(f, a);
                    if (-1 == d) return c;
                    c.push(d)
                }
                f.aiDisplay = f.aiDisplayMaster.slice();
                (b === m || b) && $(f);
                return c
            };
            this.fnAdjustColumnSizing = function (a) {
                var b = t(this[j.ext.iApiIndex]);
                k(b);
                a === m || a ? this.fnDraw(!1) : ("" !== b.oScroll.sX || "" !== b.oScroll.sY) && this.oApi._fnScrollDraw(b)
            };
            this.fnClearTable = function (a) {
                var b = t(this[j.ext.iApiIndex]);
                ea(b);
                (a === m || a) && z(b)
            };
            this.fnClose = function (a) {
                for (var b = t(this[j.ext.iApiIndex]), c = 0; c < b.aoOpenRows.length; c++) if (b.aoOpenRows[c].nParent == a) return (a = b.aoOpenRows[c].nTr.parentNode) && a.removeChild(b.aoOpenRows[c].nTr), b.aoOpenRows.splice(c, 1), 0;
                return 1
            };
            this.fnDeleteRow = function (a, b, c) {
                var d = t(this[j.ext.iApiIndex]),
                    f, g, a = "object" === typeof a ? K(d, a) : a,
                    e = d.aoData.splice(a, 1);
                for (f = 0, g = d.aoData.length; f < g; f++) if (null !== d.aoData[f].nTr) d.aoData[f].nTr._DT_RowIndex = f;
                f = h.inArray(a, d.aiDisplay);
                d.asDataSearch.splice(f, 1);
                fa(d.aiDisplayMaster, a);
                fa(d.aiDisplay, a);
                "function" === typeof b && b.call(this, d, e);
                if (d._iDisplayStart >= d.aiDisplay.length && (d._iDisplayStart -= d._iDisplayLength, 0 > d._iDisplayStart)) d._iDisplayStart = 0;
                if (c === m || c) B(d), z(d);
                return e
            };
            this.fnDestroy = function (a) {
                var b = t(this[j.ext.iApiIndex]),
                    c = b.nTableWrapper.parentNode,
                    d = b.nTBody,
                    f, g, a = a === m ? !1 : !0;
                b.bDestroying = !0;
                D(b, "aoDestroyCallback", "destroy", [b]);
                for (f = 0, g = b.aoColumns.length; f < g; f++)!1 === b.aoColumns[f].bVisible && this.fnSetColumnVis(f, !0);
                h(b.nTableWrapper).find("*").andSelf().unbind(".DT");
                h("tbody>tr>td." + b.oClasses.sRowEmpty, b.nTable).parent().remove();
                b.nTable != b.nTHead.parentNode && (h(b.nTable).children("thead").remove(), b.nTable.appendChild(b.nTHead));
                b.nTFoot && b.nTable != b.nTFoot.parentNode && (h(b.nTable).children("tfoot").remove(), b.nTable.appendChild(b.nTFoot));
                b.nTable.parentNode.removeChild(b.nTable);
                h(b.nTableWrapper).remove();
                b.aaSorting = [];
                b.aaSortingFixed = [];
                Q(b);
                h(S(b)).removeClass(b.asStripeClasses.join(" "));
                h("th, td", b.nTHead).removeClass([b.oClasses.sSortable, b.oClasses.sSortableAsc, b.oClasses.sSortableDesc, b.oClasses.sSortableNone].join(" "));
                b.bJUI && (h("th span." + b.oClasses.sSortIcon + ", td span." + b.oClasses.sSortIcon, b.nTHead).remove(), h("th, td", b.nTHead).each(function () {
                    var a = h("div." + b.oClasses.sSortJUIWrapper, this),
                        c = a.contents();
                    h(this).append(c);
                    a.remove()
                }));
                !a && b.nTableReinsertBefore ? c.insertBefore(b.nTable, b.nTableReinsertBefore) : a || c.appendChild(b.nTable);
                for (f = 0, g = b.aoData.length; f < g; f++) null !== b.aoData[f].nTr && d.appendChild(b.aoData[f].nTr);
                if (!0 === b.oFeatures.bAutoWidth) b.nTable.style.width = q(b.sDestroyWidth);
                h(d).children("tr:even").addClass(b.asDestroyStripes[0]);
                h(d).children("tr:odd").addClass(b.asDestroyStripes[1]);
                for (f = 0, g = j.settings.length; f < g; f++) j.settings[f] == b && j.settings.splice(f, 1);
                b = null
            };
            this.fnDraw = function (a) {
                var b = t(this[j.ext.iApiIndex]);
                !1 === a ? (B(b), z(b)) : $(b)
            };
            this.fnFilter = function (a, b, c, d, f, g) {
                var e = t(this[j.ext.iApiIndex]);
                if (e.oFeatures.bFilter) {
                    if (c === m || null === c) c = !1;
                    if (d === m || null === d) d = !0;
                    if (f === m || null === f) f = !0;
                    if (g === m || null === g) g = !0;
                    if (b === m || null === b) {
                        if (M(e, {
                            sSearch: a + "",
                            bRegex: c,
                            bSmart: d,
                            bCaseInsensitive: g
                        }, 1), f && e.aanFeatures.f) {
                            b = e.aanFeatures.f;
                            c = 0;
                            for (d = b.length; c < d; c++) h(b[c]._DT_Input).val(a)
                        }
                    } else h.extend(e.aoPreSearchCols[b], {
                        sSearch: a + "",
                        bRegex: c,
                        bSmart: d,
                        bCaseInsensitive: g
                    }), M(e, e.oPreviousSearch, 1)
                }
            };
            this.fnGetData = function (a, b) {
                var c = t(this[j.ext.iApiIndex]);
                if (a !== m) {
                    var d = a;
                    if ("object" === typeof a) {
                        var f = a.nodeName.toLowerCase();
                        "tr" === f ? d = K(c, a) : "td" === f && (d = K(c, a.parentNode), b = da(c, d, a))
                    }
                    return b !== m ? w(c, d, b, "") : c.aoData[d] !== m ? c.aoData[d]._aData : null
                }
                return Y(c)
            };
            this.fnGetNodes = function (a) {
                var b = t(this[j.ext.iApiIndex]);
                return a !== m ? b.aoData[a] !== m ? b.aoData[a].nTr : null : S(b)
            };
            this.fnGetPosition = function (a) {
                var b = t(this[j.ext.iApiIndex]),
                    c = a.nodeName.toUpperCase();
                if ("TR" == c) return K(b, a);
                return "TD" == c || "TH" == c ? (c = K(b, a.parentNode), a = da(b, c, a), [c, r(b, a), a]) : null
            };
            this.fnIsOpen = function (a) {
                for (var b = t(this[j.ext.iApiIndex]), c = 0; c < b.aoOpenRows.length; c++) if (b.aoOpenRows[c].nParent == a) return !0;
                return !1
            };
            this.fnOpen = function (a, b, c) {
                var d = t(this[j.ext.iApiIndex]),
                    f = S(d);
                if (-1 !== h.inArray(a, f)) {
                    this.fnClose(a);
                    var f = l.createElement("tr"),
                        g = l.createElement("td");
                    f.appendChild(g);
                    g.className = c;
                    g.colSpan = v(d);
                    "string" === typeof b ? g.innerHTML = b : h(g).html(b);
                    b = h("tr", d.nTBody); - 1 != h.inArray(a, b) && h(f).insertAfter(a);
                    d.aoOpenRows.push({
                        nTr: f,
                        nParent: a
                    });
                    return f
                }
            };
            this.fnPageChange = function (a, b) {
                var c = t(this[j.ext.iApiIndex]);
                pa(c, a);
                B(c);
                (b === m || b) && z(c)
            };
            this.fnSetColumnVis = function (a, b, c) {
                var d = t(this[j.ext.iApiIndex]),
                    f, g, e = d.aoColumns,
                    h = d.aoData,
                    o, n;
                if (e[a].bVisible != b) {
                    if (b) {
                        for (f = g = 0; f < a; f++) e[f].bVisible && g++;
                        n = g >= v(d);
                        if (!n) for (f = a; f < e.length; f++) if (e[f].bVisible) {
                            o = f;
                            break
                        }
                        for (f = 0, g = h.length; f < g; f++) null !== h[f].nTr && (n ? h[f].nTr.appendChild(h[f]._anHidden[a]) : h[f].nTr.insertBefore(h[f]._anHidden[a], L(d, f)[o]))
                    } else for (f = 0, g = h.length; f < g; f++) null !== h[f].nTr && (o = L(d, f)[a], h[f]._anHidden[a] = o, o.parentNode.removeChild(o));
                    e[a].bVisible = b;
                    U(d, d.aoHeader);
                    d.nTFoot && U(d, d.aoFooter);
                    for (f = 0, g = d.aoOpenRows.length; f < g; f++) d.aoOpenRows[f].nTr.colSpan = v(d);
                    if (c === m || c) k(d), z(d);
                    qa(d)
                }
            };
            this.fnSettings = function () {
                return t(this[j.ext.iApiIndex])
            };
            this.fnSort = function (a) {
                var b = t(this[j.ext.iApiIndex]);
                b.aaSorting = a;
                P(b)
            };
            this.fnSortListener = function (a, b, c) {
                ga(t(this[j.ext.iApiIndex]), a, b, c)
            };
            this.fnUpdate = function (a, b, c, d, f) {
                var e = t(this[j.ext.iApiIndex]),
                    b = "object" === typeof b ? K(e, b) : b;
                if (e.__fnUpdateDeep === m && h.isArray(a) && "object" === typeof a) {
                    e.aoData[b]._aData = a.slice();
                    e.__fnUpdateDeep = !0;
                    for (c = 0; c < e.aoColumns.length; c++) this.fnUpdate(w(e, b, c), b, c, !1, !1);
                    e.__fnUpdateDeep = m
                } else if (e.__fnUpdateDeep === m && null !== a && "object" === typeof a) {
                    e.aoData[b]._aData = h.extend(!0, {}, a);
                    e.__fnUpdateDeep = !0;
                    for (c = 0; c < e.aoColumns.length; c++) this.fnUpdate(w(e, b, c), b, c, !1, !1);
                    e.__fnUpdateDeep = m
                } else {
                    I(e, b, c, a);
                    var a = w(e, b, c, "display"),
                        i = e.aoColumns[c];
                    null !== i.fnRender && (a = R(e, b, c), i.bUseRendered && I(e, b, c, a));
                    if (null !== e.aoData[b].nTr) L(e, b)[c].innerHTML = a
                }
                c = h.inArray(b, e.aiDisplay);
                e.asDataSearch[c] = ma(e, X(e, b, "filter"));
                (f === m || f) && k(e);
                (d === m || d) && $(e);
                return 0
            };
            this.fnVersionCheck = j.ext.fnVersionCheck;
            this.oApi = {
                _fnExternApiFunc: Ua,
                _fnInitialise: aa,
                _fnInitComplete: Z,
                _fnLanguageCompat: oa,
                _fnAddColumn: o,
                _fnColumnOptions: s,
                _fnAddData: H,
                _fnCreateTr: ca,
                _fnGatherData: ua,
                _fnBuildHead: va,
                _fnDrawHead: U,
                _fnDraw: z,
                _fnReDraw: $,
                _fnAjaxUpdate: wa,
                _fnAjaxParameters: Ea,
                _fnAjaxUpdateDraw: Fa,
                _fnServerParams: ia,
                _fnAddOptionsHtml: xa,
                _fnFeatureHtmlTable: Ba,
                _fnScrollDraw: Ka,
                _fnAdjustColumnSizing: k,
                _fnFeatureHtmlFilter: za,
                _fnFilterComplete: M,
                _fnFilterCustom: Ia,
                _fnFilterColumn: Ha,
                _fnFilter: Ga,
                _fnBuildSearchArray: ja,
                _fnBuildSearchRow: ma,
                _fnFilterCreateSearch: ka,
                _fnDataToSearch: la,
                _fnSort: P,
                _fnSortAttachListener: ga,
                _fnSortingClasses: Q,
                _fnFeatureHtmlPaginate: Da,
                _fnPageChange: pa,
                _fnFeatureHtmlInfo: Ca,
                _fnUpdateInfo: Ja,
                _fnFeatureHtmlLength: ya,
                _fnFeatureHtmlProcessing: Aa,
                _fnProcessingDisplay: G,
                _fnVisibleToColumnIndex: x,
                _fnColumnIndexToVisible: r,
                _fnNodeToDataIndex: K,
                _fnVisbleColumns: v,
                _fnCalculateEnd: B,
                _fnConvertToWidth: La,
                _fnCalculateColumnWidths: ba,
                _fnScrollingWidthAdjust: Na,
                _fnGetWidestNode: Ma,
                _fnGetMaxLenString: Oa,
                _fnStringToCss: q,
                _fnDetectType: A,
                _fnSettingsFromNode: t,
                _fnGetDataMaster: Y,
                _fnGetTrNodes: S,
                _fnGetTdNodes: L,
                _fnEscapeRegex: na,
                _fnDeleteIndex: fa,
                _fnReOrderIndex: E,
                _fnColumnOrdering: y,
                _fnLog: F,
                _fnClearTable: ea,
                _fnSaveState: qa,
                _fnLoadState: Ra,
                _fnCreateCookie: function (a, b, c, d, e) {
                    var g = new Date;
                    g.setTime(g.getTime() + 1E3 * c);
                    var c = V.location.pathname.split("/"),
                        a = a + "_" + c.pop().replace(/[\/:]/g, "").toLowerCase(),
                        i;
                    null !== e ? (i = "function" === typeof h.parseJSON ? h.parseJSON(b) : eval("(" + b + ")"), b = e(a, i, g.toGMTString(), c.join("/") + "/")) : b = a + "=" + encodeURIComponent(b) + "; expires=" + g.toGMTString() + "; path=" + c.join("/") + "/";
                    e = "";
                    g = 9999999999999;
                    if (4096 < (null !== Sa(a) ? l.cookie.length : b.length + l.cookie.length) + 10) {
                        for (var a = l.cookie.split(";"), j = 0, o = a.length; j < o; j++) if (-1 != a[j].indexOf(d)) {
                            var k = a[j].split("=");
                            try {
                                i = eval("(" + decodeURIComponent(k[1]) + ")")
                            } catch (m) {
                                continue
                            }
                            if (i.iCreate && i.iCreate < g) e = k[0], g = i.iCreate
                        }
                        if ("" !== e) l.cookie = e + "=; expires=Thu, 01-Jan-1970 00:00:01 GMT; path=" + c.join("/") + "/"
                    }
                    l.cookie = b
                },
                _fnReadCookie: Sa,
                _fnDetectHeader: T,
                _fnGetUniqueThs: O,
                _fnScrollBarWidth: Pa,
                _fnApplyToChildren: N,
                _fnMap: p,
                _fnGetRowData: X,
                _fnGetCellData: w,
                _fnSetCellData: I,
                _fnGetObjectDataFn: W,
                _fnSetObjectDataFn: ta,
                _fnApplyColumnDefs: J,
                _fnBindAction: Qa,
                _fnExtend: Ta,
                _fnCallbackReg: C,
                _fnCallbackFire: D,
                _fnJsonString: Va,
                _fnRender: R,
                _fnNodeToColumnIndex: da,
                _fnInfoMacros: ha
            };
            h.extend(j.ext.oApi, this.oApi);
            for (var ra in j.ext.oApi) ra && (this[ra] = Ua(ra));
            var sa = this;
            return this.each(function () {
                var a = 0,
                    b, c, d;
                c = this.getAttribute("id");
                var f = !1,
                    g = !1;
                if ("table" != this.nodeName.toLowerCase()) F(null, 0, "Attempted to initialise DataTables on a node which is not a table: " + this.nodeName);
                else {
                    for (a = 0, b = j.settings.length; a < b; a++) {
                        if (j.settings[a].nTable == this) {
                            if (e === m || e.bRetrieve) return j.settings[a].oInstance;
                            if (e.bDestroy) {
                                j.settings[a].oInstance.fnDestroy();
                                break
                            } else {
                                F(j.settings[a], 0, "Cannot reinitialise DataTable.\n\nTo retrieve the DataTables object for this table, pass no arguments or see the docs for bRetrieve and bDestroy");
                                return
                            }
                        }
                        if (j.settings[a].sTableId == this.id) {
                            j.settings.splice(a, 1);
                            break
                        }
                    }
                    if (null === c || "" === c) this.id = c = "DataTables_Table_" + j.ext._oExternConfig.iNextUnique++;
                    var i = h.extend(!0, {}, j.models.oSettings, {
                        nTable: this,
                        oApi: sa.oApi,
                        oInit: e,
                        sDestroyWidth: h(this).width(),
                        sInstance: c,
                        sTableId: c
                    });
                    j.settings.push(i);
                    i.oInstance = 1 === sa.length ? sa : h(this).dataTable();
                    e || (e = {});
                    e.oLanguage && oa(e.oLanguage);
                    e = Ta(h.extend(!0, {}, j.defaults), e);
                    p(i.oFeatures, e, "bPaginate");
                    p(i.oFeatures, e, "bLengthChange");
                    p(i.oFeatures, e, "bFilter");
                    p(i.oFeatures, e, "bSort");
                    p(i.oFeatures, e, "bInfo");
                    p(i.oFeatures, e, "bProcessing");
                    p(i.oFeatures, e, "bAutoWidth");
                    p(i.oFeatures, e, "bSortClasses");
                    p(i.oFeatures, e, "bServerSide");
                    p(i.oFeatures, e, "bDeferRender");
                    p(i.oScroll, e, "sScrollX", "sX");
                    p(i.oScroll, e, "sScrollXInner", "sXInner");
                    p(i.oScroll, e, "sScrollY", "sY");
                    p(i.oScroll, e, "bScrollCollapse", "bCollapse");
                    p(i.oScroll, e, "bScrollInfinite", "bInfinite");
                    p(i.oScroll, e, "iScrollLoadGap", "iLoadGap");
                    p(i.oScroll, e, "bScrollAutoCss", "bAutoCss");
                    p(i, e, "asStripeClasses");
                    p(i, e, "asStripClasses", "asStripeClasses");
                    p(i, e, "fnServerData");
                    p(i, e, "fnFormatNumber");
                    p(i, e, "sServerMethod");
                    p(i, e, "aaSorting");
                    p(i, e, "aaSortingFixed");
                    p(i, e, "aLengthMenu");
                    p(i, e, "sPaginationType");
                    p(i, e, "sAjaxSource");
                    p(i, e, "sAjaxDataProp");
                    p(i, e, "iCookieDuration");
                    p(i, e, "sCookiePrefix");
                    p(i, e, "sDom");
                    p(i, e, "bSortCellsTop");
                    p(i, e, "iTabIndex");
                    p(i, e, "oSearch", "oPreviousSearch");
                    p(i, e, "aoSearchCols", "aoPreSearchCols");
                    p(i, e, "iDisplayLength", "_iDisplayLength");
                    p(i, e, "bJQueryUI", "bJUI");
                    p(i, e, "fnCookieCallback");
                    p(i, e, "fnStateLoad");
                    p(i, e, "fnStateSave");
                    p(i.oLanguage, e, "fnInfoCallback");
                    C(i, "aoDrawCallback", e.fnDrawCallback, "user");
                    C(i, "aoServerParams", e.fnServerParams, "user");
                    C(i, "aoStateSaveParams", e.fnStateSaveParams, "user");
                    C(i, "aoStateLoadParams", e.fnStateLoadParams, "user");
                    C(i, "aoStateLoaded", e.fnStateLoaded, "user");
                    C(i, "aoRowCallback", e.fnRowCallback, "user");
                    C(i, "aoRowCreatedCallback", e.fnCreatedRow, "user");
                    C(i, "aoHeaderCallback", e.fnHeaderCallback, "user");
                    C(i, "aoFooterCallback", e.fnFooterCallback, "user");
                    C(i, "aoInitComplete", e.fnInitComplete, "user");
                    C(i, "aoPreDrawCallback", e.fnPreDrawCallback, "user");
                    i.oFeatures.bServerSide && i.oFeatures.bSort && i.oFeatures.bSortClasses ? C(i, "aoDrawCallback", Q, "server_side_sort_classes") : i.oFeatures.bDeferRender && C(i, "aoDrawCallback", Q, "defer_sort_classes");
                    if (e.bJQueryUI) {
                        if (h.extend(i.oClasses, j.ext.oJUIClasses), e.sDom === j.defaults.sDom && "lfrtip" === j.defaults.sDom) i.sDom = '<"H"lfr>t<"F"ip>'
                    } else h.extend(i.oClasses, j.ext.oStdClasses);
                    h(this).addClass(i.oClasses.sTable);
                    if ("" !== i.oScroll.sX || "" !== i.oScroll.sY) i.oScroll.iBarWidth = Pa();
                    if (i.iInitDisplayStart === m) i.iInitDisplayStart = e.iDisplayStart, i._iDisplayStart = e.iDisplayStart;
                    if (e.bStateSave) i.oFeatures.bStateSave = !0, Ra(i, e), C(i, "aoDrawCallback", qa, "state_save");
                    if (null !== e.iDeferLoading) i.bDeferLoading = !0, a = h.isArray(e.iDeferLoading), i._iRecordsDisplay = a ? e.iDeferLoading[0] : e.iDeferLoading, i._iRecordsTotal = a ? e.iDeferLoading[1] : e.iDeferLoading;
                    null !== e.aaData && (g = !0);
                    "" !== e.oLanguage.sUrl ? (i.oLanguage.sUrl = e.oLanguage.sUrl, h.getJSON(i.oLanguage.sUrl, null, function (a) {
                        oa(a);
                        h.extend(!0, i.oLanguage, e.oLanguage, a);
                        aa(i)
                    }), f = !0) : h.extend(!0, i.oLanguage, e.oLanguage);
                    if (null === e.asStripeClasses) i.asStripeClasses = [i.oClasses.sStripeOdd, i.oClasses.sStripeEven];
                    c = !1;
                    d = h(this).children("tbody").children("tr");
                    for (a = 0, b = i.asStripeClasses.length; a < b; a++) if (d.filter(":lt(2)").hasClass(i.asStripeClasses[a])) {
                        c = !0;
                        break
                    }
                    if (c) i.asDestroyStripes = ["", ""], h(d[0]).hasClass(i.oClasses.sStripeOdd) && (i.asDestroyStripes[0] += i.oClasses.sStripeOdd + " "), h(d[0]).hasClass(i.oClasses.sStripeEven) && (i.asDestroyStripes[0] += i.oClasses.sStripeEven), h(d[1]).hasClass(i.oClasses.sStripeOdd) && (i.asDestroyStripes[1] += i.oClasses.sStripeOdd + " "), h(d[1]).hasClass(i.oClasses.sStripeEven) && (i.asDestroyStripes[1] += i.oClasses.sStripeEven), d.removeClass(i.asStripeClasses.join(" "));
                    c = [];
                    a = this.getElementsByTagName("thead");
                    0 !== a.length && (T(i.aoHeader, a[0]), c = O(i));
                    if (null === e.aoColumns) {
                        d = [];
                        for (a = 0, b = c.length; a < b; a++) d.push(null)
                    } else d = e.aoColumns;
                    for (a = 0, b = d.length; a < b; a++) {
                        if (e.saved_aoColumns !== m && e.saved_aoColumns.length == b) null === d[a] && (d[a] = {}), d[a].bVisible = e.saved_aoColumns[a].bVisible;
                        o(i, c ? c[a] : null)
                    }
                    J(i, e.aoColumnDefs, d, function (a, b) {
                        s(i, a, b)
                    });
                    for (a = 0, b = i.aaSorting.length; a < b; a++) {
                        i.aaSorting[a][0] >= i.aoColumns.length && (i.aaSorting[a][0] = 0);
                        var k = i.aoColumns[i.aaSorting[a][0]];
                        i.aaSorting[a][2] === m && (i.aaSorting[a][2] = 0);
                        e.aaSorting === m && i.saved_aaSorting === m && (i.aaSorting[a][1] = k.asSorting[0]);
                        for (c = 0, d = k.asSorting.length; c < d; c++) if (i.aaSorting[a][1] == k.asSorting[c]) {
                            i.aaSorting[a][2] = c;
                            break
                        }
                    }
                    Q(i);
                    a = h(this).children("caption").each(function () {
                        this._captionSide = h(this).css("caption-side")
                    });
                    b = h(this).children("thead");
                    0 === b.length && (b = [l.createElement("thead")], this.appendChild(b[0]));
                    i.nTHead = b[0];
                    b = h(this).children("tbody");
                    0 === b.length && (b = [l.createElement("tbody")], this.appendChild(b[0]));
                    i.nTBody = b[0];
                    i.nTBody.setAttribute("role", "alert");
                    i.nTBody.setAttribute("aria-live", "polite");
                    i.nTBody.setAttribute("aria-relevant", "all");
                    b = h(this).children("tfoot");
                    if (0 === b.length && 0 < a.length && ("" !== i.oScroll.sX || "" !== i.oScroll.sY)) b = [l.createElement("tfoot")], this.appendChild(b[0]);
                    if (0 < b.length) i.nTFoot = b[0], T(i.aoFooter, i.nTFoot);
                    if (g) for (a = 0; a < e.aaData.length; a++) H(i, e.aaData[a]);
                    else ua(i);
                    i.aiDisplay = i.aiDisplayMaster.slice();
                    i.bInitialised = !0;
                    !1 === f && aa(i)
                }
            })
        };
    j.fnVersionCheck = function (e) {
        for (var h = function (e, h) {
                for (; e.length < h;) e += "0";
                return e
            }, m = j.ext.sVersion.split("."), e = e.split("."), k = "", l = "", r = 0, v = e.length; r < v; r++) k += h(m[r], 3), l += h(e[r], 3);
        return parseInt(k, 10) >= parseInt(l, 10)
    };
    j.fnIsDataTable = function (e) {
        for (var h = j.settings, m = 0; m < h.length; m++) if (h[m].nTable === e || h[m].nScrollHead === e || h[m].nScrollFoot === e) return !0;
        return !1
    };
    j.fnTables = function (e) {
        var o = [];
        jQuery.each(j.settings, function (j, k) {
            (!e || !0 === e && h(k.nTable).is(":visible")) && o.push(k.nTable)
        });
        return o
    };
    j.version = "1.9.1";
    j.settings = [];
    j.models = {};
    j.models.ext = {
        afnFiltering: [],
        afnSortData: [],
        aoFeatures: [],
        aTypes: [],
        fnVersionCheck: j.fnVersionCheck,
        iApiIndex: 0,
        ofnSearch: {},
        oApi: {},
        oStdClasses: {},
        oJUIClasses: {},
        oPagination: {},
        oSort: {},
        sVersion: j.version,
        sErrMode: "alert",
        _oExternConfig: {
            iNextUnique: 0
        }
    };
    j.models.oSearch = {
        bCaseInsensitive: !0,
        sSearch: "",
        bRegex: !1,
        bSmart: !0
    };
    j.models.oRow = {
        nTr: null,
        _aData: [],
        _aSortData: [],
        _anHidden: [],
        _sRowStripe: ""
    };
    j.models.oColumn = {
        aDataSort: null,
        asSorting: null,
        bSearchable: null,
        bSortable: null,
        bUseRendered: null,
        bVisible: null,
        _bAutoType: !0,
        fnCreatedCell: null,
        fnGetData: null,
        fnRender: null,
        fnSetData: null,
        mDataProp: null,
        nTh: null,
        nTf: null,
        sClass: null,
        sContentPadding: null,
        sDefaultContent: null,
        sName: null,
        sSortDataType: "std",
        sSortingClass: null,
        sSortingClassJUI: null,
        sTitle: null,
        sType: null,
        sWidth: null,
        sWidthOrig: null
    };
    j.defaults = {
        aaData: null,
        aaSorting: [
            [0, "asc"]
        ],
        aaSortingFixed: null,
        aLengthMenu: [10, 25, 50, 100],
        aoColumns: null,
        aoColumnDefs: null,
        aoSearchCols: [],
        asStripeClasses: null,
        bAutoWidth: !0,
        bDeferRender: !1,
        bDestroy: !1,
        bFilter: !0,
        bInfo: !0,
        bJQueryUI: !1,
        bLengthChange: !0,
        bPaginate: !0,
        bProcessing: !1,
        bRetrieve: !1,
        bScrollAutoCss: !0,
        bScrollCollapse: !1,
        bScrollInfinite: !1,
        bServerSide: !1,
        bSort: !0,
        bSortCellsTop: !1,
        bSortClasses: !0,
        bStateSave: !1,
        fnCookieCallback: null,
        fnCreatedRow: null,
        fnDrawCallback: null,
        fnFooterCallback: null,
        fnFormatNumber: function (e) {
            if (1E3 > e) return e;
            for (var h = e + "", e = h.split(""), j = "", h = h.length, k = 0; k < h; k++) 0 === k % 3 && 0 !== k && (j = this.oLanguage.sInfoThousands + j), j = e[h - k - 1] + j;
            return j
        },
        fnHeaderCallback: null,
        fnInfoCallback: null,
        fnInitComplete: null,
        fnPreDrawCallback: null,
        fnRowCallback: null,
        fnServerData: function (e, j, m, k) {
            k.jqXHR = h.ajax({
                url: e,
                data: j,
                success: function (e) {
                    h(k.oInstance).trigger("xhr", k);
                    m(e)
                },
                dataType: "json",
                cache: !1,
                type: k.sServerMethod,
                error: function (e, h) {
                    "parsererror" == h && k.oApi._fnLog(k, 0, "DataTables warning: JSON data from server could not be parsed. This is caused by a JSON formatting error.")
                }
            })
        },
        fnServerParams: null,
        fnStateLoad: function (e) {
            var e = this.oApi._fnReadCookie(e.sCookiePrefix + e.sInstance),
                j;
            try {
                j = "function" === typeof h.parseJSON ? h.parseJSON(e) : eval("(" + e + ")")
            } catch (m) {
                j = null
            }
            return j
        },
        fnStateLoadParams: null,
        fnStateLoaded: null,
        fnStateSave: function (e, h) {
            this.oApi._fnCreateCookie(e.sCookiePrefix + e.sInstance, this.oApi._fnJsonString(h), e.iCookieDuration, e.sCookiePrefix, e.fnCookieCallback)
        },
        fnStateSaveParams: null,
        iCookieDuration: 7200,
        iDeferLoading: null,
        iDisplayLength: 50,
        iDisplayStart: 0,
        iScrollLoadGap: 100,
        iTabIndex: 0,
        oLanguage: {
            oAria: {
                sSortAscending: ": activate to sort column ascending",
                sSortDescending: ": activate to sort column descending"
            },
            oPaginate: {
                sFirst: "First",
                sLast: "Last",
                sNext: "Next",
                sPrevious: "Previous"
            },
            sEmptyTable: "No data available in table",
            sInfo: "Showing _START_ to _END_ of _TOTAL_ entries",
            sInfoEmpty: "Showing 0 to 0 of 0 entries",
            sInfoFiltered: "(filtered from _MAX_ total entries)",
            sInfoPostFix: "",
            sInfoThousands: ",",
            sLengthMenu: "<span class='showentries'>Show entries:</span> _MENU_ ",
            sLoadingRecords: "Loading...",
            sProcessing: "Processing...",
            sSearch: "<span>Search:</span>",
            sUrl: "",
            sZeroRecords: "No matching records found"
        },
        oSearch: h.extend({}, j.models.oSearch),
        sAjaxDataProp: "aaData",
        sAjaxSource: null,
        sCookiePrefix: "SpryMedia_DataTables_",
        sDom: "lfrtip",
        sPaginationType: "two_button",
        sScrollX: "",
        sScrollXInner: "",
        sScrollY: "",
        sServerMethod: "GET"
    };
    j.defaults.columns = {
        aDataSort: null,
        asSorting: ["asc", "desc"],
        bSearchable: !0,
        bSortable: !0,
        bUseRendered: !0,
        bVisible: !0,
        fnCreatedCell: null,
        fnRender: null,
        iDataSort: -1,
        mDataProp: null,
        sCellType: "td",
        sClass: "",
        sContentPadding: "",
        sDefaultContent: null,
        sName: "",
        sSortDataType: "std",
        sTitle: null,
        sType: null,
        sWidth: null
    };
    j.models.oSettings = {
        oFeatures: {
            bAutoWidth: null,
            bDeferRender: null,
            bFilter: null,
            bInfo: null,
            bLengthChange: null,
            bPaginate: null,
            bProcessing: null,
            bServerSide: null,
            bSort: null,
            bSortClasses: null,
            bStateSave: null
        },
        oScroll: {
            bAutoCss: null,
            bCollapse: null,
            bInfinite: null,
            iBarWidth: 0,
            iLoadGap: null,
            sX: null,
            sXInner: null,
            sY: null
        },
        oLanguage: {
            fnInfoCallback: null
        },
        aanFeatures: [],
        aoData: [],
        aiDisplay: [],
        aiDisplayMaster: [],
        aoColumns: [],
        aoHeader: [],
        aoFooter: [],
        asDataSearch: [],
        oPreviousSearch: {},
        aoPreSearchCols: [],
        aaSorting: null,
        aaSortingFixed: null,
        asStripeClasses: null,
        asDestroyStripes: [],
        sDestroyWidth: 0,
        aoRowCallback: [],
        aoHeaderCallback: [],
        aoFooterCallback: [],
        aoDrawCallback: [],
        aoRowCreatedCallback: [],
        aoPreDrawCallback: [],
        aoInitComplete: [],
        aoStateSaveParams: [],
        aoStateLoadParams: [],
        aoStateLoaded: [],
        sTableId: "",
        nTable: null,
        nTHead: null,
        nTFoot: null,
        nTBody: null,
        nTableWrapper: null,
        bDeferLoading: !1,
        bInitialised: !1,
        aoOpenRows: [],
        sDom: null,
        sPaginationType: "two_button",
        iCookieDuration: 0,
        sCookiePrefix: "",
        fnCookieCallback: null,
        aoStateSave: [],
        aoStateLoad: [],
        oLoadedState: null,
        sAjaxSource: null,
        sAjaxDataProp: null,
        bAjaxDataGet: !0,
        jqXHR: null,
        fnServerData: null,
        aoServerParams: [],
        sServerMethod: null,
        fnFormatNumber: null,
        aLengthMenu: null,
        iDraw: 0,
        bDrawing: !1,
        iDrawError: -1,
        _iDisplayLength: 50,
        _iDisplayStart: 0,
        _iDisplayEnd: 10,
        _iRecordsTotal: 0,
        _iRecordsDisplay: 0,
        bJUI: null,
        oClasses: {},
        bFiltered: !1,
        bSorted: !1,
        bSortCellsTop: null,
        oInit: null,
        aoDestroyCallback: [],
        fnRecordsTotal: function () {
            return this.oFeatures.bServerSide ? parseInt(this._iRecordsTotal, 10) : this.aiDisplayMaster.length
        },
        fnRecordsDisplay: function () {
            return this.oFeatures.bServerSide ? parseInt(this._iRecordsDisplay, 10) : this.aiDisplay.length
        },
        fnDisplayEnd: function () {
            return this.oFeatures.bServerSide ? !1 === this.oFeatures.bPaginate || -1 == this._iDisplayLength ? this._iDisplayStart + this.aiDisplay.length : Math.min(this._iDisplayStart + this._iDisplayLength, this._iRecordsDisplay) : this._iDisplayEnd
        },
        oInstance: null,
        sInstance: null,
        iTabIndex: 0,
        nScrollHead: null,
        nScrollFoot: null
    };
    j.ext = h.extend(!0, {}, j.models.ext);
    h.extend(j.ext.oStdClasses, {
        sTable: "dataTable",
        sPagePrevEnabled: "paginate_enabled_previous",
        sPagePrevDisabled: "paginate_disabled_previous",
        sPageNextEnabled: "paginate_enabled_next",
        sPageNextDisabled: "paginate_disabled_next",
        sPageJUINext: "",
        sPageJUIPrev: "",
        sPageButton: "paginate_button",
        sPageButtonActive: "paginate_active",
        sPageButtonStaticDisabled: "paginate_button paginate_button_disabled",
        sPageFirst: "first",
        sPagePrevious: "previous",
        sPageNext: "next",
        sPageLast: "last",
        sStripeOdd: "odd",
        sStripeEven: "even",
        sRowEmpty: "dataTables_empty",
        sWrapper: "dataTables_wrapper",
        sFilter: "dataTables_filter",
        sInfo: "dataTables_info",
        sPaging: "dataTables_paginate paging_",
        sLength: "dataTables_length",
        sProcessing: "dataTables_processing",
        sSortAsc: "sorting_asc",
        sSortDesc: "sorting_desc",
        sSortable: "sorting",
        sSortableAsc: "sorting_asc_disabled",
        sSortableDesc: "sorting_desc_disabled",
        sSortableNone: "sorting_disabled",
        sSortColumn: "sorting_",
        sSortJUIAsc: "",
        sSortJUIDesc: "",
        sSortJUI: "",
        sSortJUIAscAllowed: "",
        sSortJUIDescAllowed: "",
        sSortJUIWrapper: "",
        sSortIcon: "",
        sScrollWrapper: "dataTables_scroll",
        sScrollHead: "dataTables_scrollHead",
        sScrollHeadInner: "dataTables_scrollHeadInner",
        sScrollBody: "dataTables_scrollBody",
        sScrollFoot: "dataTables_scrollFoot",
        sScrollFootInner: "dataTables_scrollFootInner",
        sFooterTH: ""
    });
    h.extend(j.ext.oJUIClasses, j.ext.oStdClasses, {
        sPagePrevEnabled: "fg-button ui-button ui-state-default ui-corner-left",
        sPagePrevDisabled: "fg-button ui-button ui-state-default ui-corner-left ui-state-disabled",
        sPageNextEnabled: "fg-button ui-button ui-state-default ui-corner-right",
        sPageNextDisabled: "fg-button ui-button ui-state-default ui-corner-right ui-state-disabled",
        sPageJUINext: "ui-icon ui-icon-circle-arrow-e",
        sPageJUIPrev: "ui-icon ui-icon-circle-arrow-w",
        sPageButton: "fg-button ui-button ui-state-default",
        sPageButtonActive: "fg-button ui-button ui-state-default ui-state-disabled",
        sPageButtonStaticDisabled: "fg-button ui-button ui-state-default ui-state-disabled",
        sPageFirst: "first ui-corner-tl ui-corner-bl",
        sPageLast: "last ui-corner-tr ui-corner-br",
        sPaging: "dataTables_paginate fg-buttonset ui-buttonset fg-buttonset-multi ui-buttonset-multi paging_",
        sSortAsc: "ui-state-default",
        sSortDesc: "ui-state-default",
        sSortable: "ui-state-default",
        sSortableAsc: "ui-state-default",
        sSortableDesc: "ui-state-default",
        sSortableNone: "ui-state-default",
        sSortJUIAsc: "css_right ui-icon ui-icon-triangle-1-n",
        sSortJUIDesc: "css_right ui-icon ui-icon-triangle-1-s",
        sSortJUI: "css_right ui-icon ui-icon-carat-2-n-s",
        sSortJUIAscAllowed: "css_right ui-icon ui-icon-carat-1-n",
        sSortJUIDescAllowed: "css_right ui-icon ui-icon-carat-1-s",
        sSortJUIWrapper: "DataTables_sort_wrapper",
        sSortIcon: "DataTables_sort_icon",
        sScrollHead: "dataTables_scrollHead ui-state-default",
        sScrollFoot: "dataTables_scrollFoot ui-state-default",
        sFooterTH: "ui-state-default"
    });
    h.extend(j.ext.oPagination, {
        two_button: {
            fnInit: function (e, j, m) {
                var k = e.oLanguage.oPaginate,
                    l = function (h) {
                        e.oApi._fnPageChange(e, h.data.action) && m(e)
                    },
                    k = !e.bJUI ? '<a class="' + e.oClasses.sPagePrevDisabled + '" tabindex="' + e.iTabIndex + '" role="button">' + k.sPrevious + '</a><a class="' + e.oClasses.sPageNextDisabled + '" tabindex="' + e.iTabIndex + '" role="button">' + k.sNext + "</a>" : '<a class="' + e.oClasses.sPagePrevDisabled + '" tabindex="' + e.iTabIndex + '" role="button"><span class="' + e.oClasses.sPageJUIPrev + '"></span></a><a class="' + e.oClasses.sPageNextDisabled + '" tabindex="' + e.iTabIndex + '" role="button"><span class="' + e.oClasses.sPageJUINext + '"></span></a>';
                h(j).append(k);
                var r = h("a", j),
                    k = r[0],
                    r = r[1];
                e.oApi._fnBindAction(k, {
                    action: "previous"
                }, l);
                e.oApi._fnBindAction(r, {
                    action: "next"
                }, l);
                if (!e.aanFeatures.p) j.id = e.sTableId + "_paginate", k.id = e.sTableId + "_previous", r.id = e.sTableId + "_next", k.setAttribute("aria-controls", e.sTableId), r.setAttribute("aria-controls", e.sTableId)
            },
            fnUpdate: function (e) {
                if (e.aanFeatures.p) for (var h = e.oClasses, j = e.aanFeatures.p, k = 0, m = j.length; k < m; k++) if (0 !== j[k].childNodes.length) j[k].childNodes[0].className = 0 === e._iDisplayStart ? h.sPagePrevDisabled : h.sPagePrevEnabled, j[k].childNodes[1].className = e.fnDisplayEnd() == e.fnRecordsDisplay() ? h.sPageNextDisabled : h.sPageNextEnabled
            }
        },
        iFullNumbersShowPages: 5,
        full_numbers: {
            fnInit: function (e, j, m) {
                var k = e.oLanguage.oPaginate,
                    l = e.oClasses,
                    r = function (h) {
                        e.oApi._fnPageChange(e, h.data.action) && m(e)
                    };
                h(j).append('<a  tabindex="' + e.iTabIndex + '" class="' + l.sPageButton + " " + l.sPageFirst + '">' + k.sFirst + '</a><a  tabindex="' + e.iTabIndex + '" class="' + l.sPageButton + " " + l.sPagePrevious + '">' + k.sPrevious + '</a><span></span><a tabindex="' + e.iTabIndex + '" class="' + l.sPageButton + " " + l.sPageNext + '">' + k.sNext + '</a><a tabindex="' + e.iTabIndex + '" class="' + l.sPageButton + " " + l.sPageLast + '">' + k.sLast + "</a>");
                var v = h("a", j),
                    k = v[0],
                    l = v[1],
                    A = v[2],
                    v = v[3];
                e.oApi._fnBindAction(k, {
                    action: "first"
                }, r);
                e.oApi._fnBindAction(l, {
                    action: "previous"
                }, r);
                e.oApi._fnBindAction(A, {
                    action: "next"
                }, r);
                e.oApi._fnBindAction(v, {
                    action: "last"
                }, r);
                if (!e.aanFeatures.p) j.id = e.sTableId + "_paginate", k.id = e.sTableId + "_first", l.id = e.sTableId + "_previous", A.id = e.sTableId + "_next", v.id = e.sTableId + "_last"
            },
            fnUpdate: function (e, m) {
                if (e.aanFeatures.p) {
                    var l = j.ext.oPagination.iFullNumbersShowPages,
                        k = Math.floor(l / 2),
                        x = Math.ceil(e.fnRecordsDisplay() / e._iDisplayLength),
                        r = Math.ceil(e._iDisplayStart / e._iDisplayLength) + 1,
                        v = "",
                        A, E = e.oClasses,
                        y, J = e.aanFeatures.p,
                        H = function (h) {
                            e.oApi._fnBindAction(this, {
                                page: h + A - 1
                            }, function (h) {
                                e.oApi._fnPageChange(e, h.data.page);
                                m(e);
                                h.preventDefault()
                            })
                        }; - 1 === e._iDisplayLength ? r = k = A = 1 : x < l ? (A = 1, k = x) : r <= k ? (A = 1, k = l) : r >= x - k ? (A = x - l + 1, k = x) : (A = r - Math.ceil(l / 2) + 1, k = A + l - 1);
                    for (l = A; l <= k; l++) v += r !== l ? '<a tabindex="' + e.iTabIndex + '" class="' + E.sPageButton + '">' + e.fnFormatNumber(l) + "</a>" : '<a tabindex="' + e.iTabIndex + '" class="' + E.sPageButtonActive + '">' + e.fnFormatNumber(l) + "</a>";
                    for (l = 0, k = J.length; l < k; l++) 0 !== J[l].childNodes.length && (h("span:eq(0)", J[l]).html(v).children("a").each(H), y = J[l].getElementsByTagName("a"), y = [y[0], y[1], y[y.length - 2], y[y.length - 1]], h(y).removeClass(E.sPageButton + " " + E.sPageButtonActive + " " + E.sPageButtonStaticDisabled), h([y[0], y[1]]).addClass(1 == r ? E.sPageButtonStaticDisabled : E.sPageButton), h([y[2], y[3]]).addClass(0 === x || r === x || -1 === e._iDisplayLength ? E.sPageButtonStaticDisabled : E.sPageButton))
                }
            }
        }
    });
    h.extend(j.ext.oSort, {
        "string-pre": function (e) {
            "string" != typeof e && (e = null !== e && e.toString ? e.toString() : "");
            return e.toLowerCase()
        },
        "string-asc": function (e, h) {
            return e < h ? -1 : e > h ? 1 : 0
        },
        "string-desc": function (e, h) {
            return e < h ? 1 : e > h ? -1 : 0
        },
        "html-pre": function (e) {
            return e.replace(/<.*?>/g, "").toLowerCase()
        },
        "html-asc": function (e, h) {
            return e < h ? -1 : e > h ? 1 : 0
        },
        "html-desc": function (e, h) {
            return e < h ? 1 : e > h ? -1 : 0
        },
        "date-pre": function (e) {
            e = Date.parse(e);
            if (isNaN(e) || "" === e) e = Date.parse("01/01/1970 00:00:00");
            return e
        },
        "date-asc": function (e, h) {
            return e - h
        },
        "date-desc": function (e, h) {
            return h - e
        },
        "numeric-pre": function (e) {
            return "-" == e || "" === e ? 0 : 1 * e
        },
        "numeric-asc": function (e, h) {
            return e - h
        },
        "numeric-desc": function (e, h) {
            return h - e
        }
    });
    h.extend(j.ext.aTypes, [function (e) {
        if ("number" === typeof e) return "numeric";
        if ("string" !== typeof e) return null;
        var h, j = !1;
        h = e.charAt(0);
        if (-1 == "0123456789-".indexOf(h)) return null;
        for (var k = 1; k < e.length; k++) {
            h = e.charAt(k);
            if (-1 == "0123456789.".indexOf(h)) return null;
            if ("." == h) {
                if (j) return null;
                j = !0
            }
        }
        return "numeric"
    }, function (e) {
        var h = Date.parse(e);
        return null !== h && !isNaN(h) || "string" === typeof e && 0 === e.length ? "date" : null
    }, function (e) {
        return "string" === typeof e && -1 != e.indexOf("<") && -1 != e.indexOf(">") ? "html" : null
    }]);
    h.fn.DataTable = j;
    h.fn.dataTable = j;
    h.fn.dataTableSettings = j.settings;
    h.fn.dataTableExt = j.ext
})(jQuery, window, document, void 0);