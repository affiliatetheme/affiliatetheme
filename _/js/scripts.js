/*
 * Bootstrap Slider
 */
!function (t) {
    if ("function" == typeof define && define.amd) try {
        define(["jquery"], t)
    } catch (i) {
        define([], t)
    } else if ("object" == typeof module && module.exports) {
        var e;
        try {
            e = require("jquery")
        } catch (i) {
            e = null
        }
        module.exports = t(e)
    } else window && (window.Slider = t(window.jQuery))
}(function (t) {
    var i;
    return function (t) {
        "use strict";

        function i() {
        }

        function e(t) {
            function e(i) {
                i.prototype.option || (i.prototype.option = function (i) {
                    t.isPlainObject(i) && (this.options = t.extend(!0, this.options, i))
                })
            }

            function o(i, e) {
                t.fn[i] = function (o) {
                    if ("string" == typeof o) {
                        for (var a = s.call(arguments, 1), h = 0, l = this.length; l > h; h++) {
                            var r = this[h], p = t.data(r, i);
                            if (p) if (t.isFunction(p[o]) && "_" !== o.charAt(0)) {
                                var d = p[o].apply(p, a);
                                if (void 0 !== d && d !== p) return d
                            } else n("no such method '" + o + "' for " + i + " instance"); else n("cannot call methods on " + i + " prior to initialization; attempted to call '" + o + "'")
                        }
                        return this
                    }
                    var c = this.map(function () {
                        var s = t.data(this, i);
                        return s ? (s.option(o), s._init()) : (s = new e(this, o), t.data(this, i, s)), t(this)
                    });
                    return !c || c.length > 1 ? c : c[0]
                }
            }

            if (t) {
                var n = "undefined" == typeof console ? i : function (t) {
                    console.error(t)
                };
                return t.bridget = function (t, i) {
                    e(i), o(t, i)
                }, t.bridget
            }
        }

        var s = Array.prototype.slice;
        e(t)
    }(t), function (t) {
        function e(i, e) {
            function s(t, i) {
                var e = "data-slider-" + i.replace(/_/g, "-"), s = t.getAttribute(e);
                try {
                    return JSON.parse(s)
                } catch (o) {
                    return s
                }
            }

            this._state = {
                value: null,
                enabled: null,
                offset: null,
                size: null,
                percentage: null,
                inDrag: !1,
                over: !1
            }, "string" == typeof i ? this.element = document.querySelector(i) : i instanceof HTMLElement && (this.element = i), e = e ? e : {};
            for (var n = Object.keys(this.defaultOptions), a = 0; a < n.length; a++) {
                var h = n[a], l = e[h];
                this._state.atio_element;
                l = "undefined" != typeof l ? l : s(this.element, h), l = null !== l ? l : this.defaultOptions[h], this.options || (this.options = {}), this.options[h] = l
            }
            "vertical" !== this.options.orientation || "top" !== this.options.tooltip_position && "bottom" !== this.options.tooltip_position ? "horizontal" !== this.options.orientation || "left" !== this.options.tooltip_position && "right" !== this.options.tooltip_position || (this.options.tooltip_position = "top") : this.options.tooltip_position = "right";
            var r, p, d, c, u, m = this.element.style.width, _ = !1, v = this.element.parentNode;
            if (this.sliderElem) _ = !0; else {
                this.sliderElem = document.createElement("div"), this.sliderElem.className = "slider";
                var f = document.createElement("div");
                f.className = "slider-track", p = document.createElement("div"), p.className = "slider-track-low", r = document.createElement("div"), r.className = "slider-selection", d = document.createElement("div"), d.className = "slider-track-high", c = document.createElement("div"), c.className = "slider-handle min-slider-handle", c.setAttribute("role", "slider"), c.setAttribute("aria-valuemin", this.options.min), c.setAttribute("aria-valuemax", this.options.max), u = document.createElement("div"), u.className = "slider-handle max-slider-handle", u.setAttribute("role", "slider"), u.setAttribute("aria-valuemin", this.options.min), u.setAttribute("aria-valuemax", this.options.max), f.appendChild(p), f.appendChild(r), f.appendChild(d);
                var g = Array.isArray(this.options.labelledby);
                if (g && this.options.labelledby[0] && c.setAttribute("aria-labelledby", this.options.labelledby[0]), g && this.options.labelledby[1] && u.setAttribute("aria-labelledby", this.options.labelledby[1]), !g && this.options.labelledby && (c.setAttribute("aria-labelledby", this.options.labelledby), u.setAttribute("aria-labelledby", this.options.labelledby)), this.ticks = [], Array.isArray(this.options.ticks) && this.options.ticks.length > 0) {
                    for (a = 0; a < this.options.ticks.length; a++) {
                        var y = document.createElement("div");
                        y.className = "slider-tick", this.ticks.push(y), f.appendChild(y)
                    }
                    r.className += " tick-slider-selection"
                }
                if (f.appendChild(c), f.appendChild(u), this.tickLabels = [], Array.isArray(this.options.ticks_labels) && this.options.ticks_labels.length > 0) for (this.tickLabelContainer = document.createElement("div"), this.tickLabelContainer.className = "slider-tick-label-container", a = 0; a < this.options.ticks_labels.length; a++) {
                    var b = document.createElement("div"), k = 0 === this.options.ticks_positions.length,
                        E = this.options.reversed && k ? this.options.ticks_labels.length - (a + 1) : a;
                    b.className = "slider-tick-label", b.innerHTML = this.options.ticks_labels[E], this.tickLabels.push(b), this.tickLabelContainer.appendChild(b)
                }
                var x = function (t) {
                    var i = document.createElement("div");
                    i.className = "tooltip-arrow";
                    var e = document.createElement("div");
                    e.className = "tooltip-inner", t.appendChild(i), t.appendChild(e)
                }, C = document.createElement("div");
                C.className = "tooltip tooltip-main", C.setAttribute("role", "presentation"), x(C);
                var w = document.createElement("div");
                w.className = "tooltip tooltip-min", w.setAttribute("role", "presentation"), x(w);
                var L = document.createElement("div");
                L.className = "tooltip tooltip-max", L.setAttribute("role", "presentation"), x(L), this.sliderElem.appendChild(f), this.sliderElem.appendChild(C), this.sliderElem.appendChild(w), this.sliderElem.appendChild(L), this.tickLabelContainer && this.sliderElem.appendChild(this.tickLabelContainer), v.insertBefore(this.sliderElem, this.element), this.element.style.display = "none"
            }
            if (t && (this.$element = t(this.element), this.$sliderElem = t(this.sliderElem)), this.eventToCallbackMap = {}, this.sliderElem.id = this.options.id, this.touchCapable = "ontouchstart" in window || window.DocumentTouch && document instanceof window.DocumentTouch, this.touchX = 0, this.touchY = 0, this.tooltip = this.sliderElem.querySelector(".tooltip-main"), this.tooltipInner = this.tooltip.querySelector(".tooltip-inner"), this.tooltip_min = this.sliderElem.querySelector(".tooltip-min"), this.tooltipInner_min = this.tooltip_min.querySelector(".tooltip-inner"), this.tooltip_max = this.sliderElem.querySelector(".tooltip-max"), this.tooltipInner_max = this.tooltip_max.querySelector(".tooltip-inner"), o[this.options.scale] && (this.options.scale = o[this.options.scale]), _ === !0 && (this._removeClass(this.sliderElem, "slider-horizontal"), this._removeClass(this.sliderElem, "slider-vertical"), this._removeClass(this.tooltip, "hide"), this._removeClass(this.tooltip_min, "hide"), this._removeClass(this.tooltip_max, "hide"), ["left", "top", "width", "height"].forEach(function (t) {
                this._removeProperty(this.trackLow, t), this._removeProperty(this.trackSelection, t), this._removeProperty(this.trackHigh, t)
            }, this), [this.handle1, this.handle2].forEach(function (t) {
                this._removeProperty(t, "left"), this._removeProperty(t, "top")
            }, this), [this.tooltip, this.tooltip_min, this.tooltip_max].forEach(function (t) {
                this._removeProperty(t, "left"), this._removeProperty(t, "top"), this._removeProperty(t, "margin-left"), this._removeProperty(t, "margin-top"), this._removeClass(t, "right"), this._removeClass(t, "top")
            }, this)), "vertical" === this.options.orientation ? (this._addClass(this.sliderElem, "slider-vertical"), this.stylePos = "top", this.mousePos = "pageY", this.sizePos = "offsetHeight") : (this._addClass(this.sliderElem, "slider-horizontal"), this.sliderElem.style.width = m, this.options.orientation = "horizontal", this.stylePos = "left", this.mousePos = "pageX", this.sizePos = "offsetWidth"), this._setTooltipPosition(), Array.isArray(this.options.ticks) && this.options.ticks.length > 0 && (this.options.max = Math.max.apply(Math, this.options.ticks), this.options.min = Math.min.apply(Math, this.options.ticks)), Array.isArray(this.options.value) ? (this.options.range = !0, this._state.value = this.options.value) : this.options.range ? this._state.value = [this.options.value, this.options.max] : this._state.value = this.options.value, this.trackLow = p || this.trackLow, this.trackSelection = r || this.trackSelection, this.trackHigh = d || this.trackHigh, "none" === this.options.selection && (this._addClass(this.trackLow, "hide"), this._addClass(this.trackSelection, "hide"), this._addClass(this.trackHigh, "hide")), this.handle1 = c || this.handle1, this.handle2 = u || this.handle2, _ === !0) for (this._removeClass(this.handle1, "round triangle"), this._removeClass(this.handle2, "round triangle hide"), a = 0; a < this.ticks.length; a++) this._removeClass(this.ticks[a], "round triangle hide");
            var T = ["round", "triangle", "custom"], P = -1 !== T.indexOf(this.options.handle);
            if (P) for (this._addClass(this.handle1, this.options.handle), this._addClass(this.handle2, this.options.handle), a = 0; a < this.ticks.length; a++) this._addClass(this.ticks[a], this.options.handle);
            this._state.offset = this._offset(this.sliderElem), this._state.size = this.sliderElem[this.sizePos], this.setValue(this._state.value), this.handle1Keydown = this._keydown.bind(this, 0), this.handle1.addEventListener("keydown", this.handle1Keydown, !1), this.handle2Keydown = this._keydown.bind(this, 1), this.handle2.addEventListener("keydown", this.handle2Keydown, !1), this.mousedown = this._mousedown.bind(this), this.touchstart = this._touchstart.bind(this), this.touchmove = this._touchmove.bind(this), this.touchCapable && (this.sliderElem.addEventListener("touchstart", this.touchstart, !1), this.sliderElem.addEventListener("touchmove", this.touchmove, !1)), this.sliderElem.addEventListener("mousedown", this.mousedown, !1), this.resize = this._resize.bind(this), window.addEventListener("resize", this.resize, !1), "hide" === this.options.tooltip ? (this._addClass(this.tooltip, "hide"), this._addClass(this.tooltip_min, "hide"), this._addClass(this.tooltip_max, "hide")) : "always" === this.options.tooltip ? (this._showTooltip(), this._alwaysShowTooltip = !0) : (this.showTooltip = this._showTooltip.bind(this), this.hideTooltip = this._hideTooltip.bind(this), this.sliderElem.addEventListener("mouseenter", this.showTooltip, !1), this.sliderElem.addEventListener("mouseleave", this.hideTooltip, !1), this.handle1.addEventListener("focus", this.showTooltip, !1), this.handle1.addEventListener("blur", this.hideTooltip, !1), this.handle2.addEventListener("focus", this.showTooltip, !1), this.handle2.addEventListener("blur", this.hideTooltip, !1)), this.options.enabled ? this.enable() : this.disable()
        }

        var s = {
            formatInvalidInputErrorMsg: function (t) {
                return "Invalid input value '" + t + "' passed in"
            },
            callingContextNotSliderInstance: "Calling context element does not have instance of Slider bound to it. Check your code to make sure the JQuery object returned from the call to the slider() initializer is calling the method"
        }, o = {
            linear: {
                toValue: function (t) {
                    var i = t / 100 * (this.options.max - this.options.min), e = !0;
                    if (this.options.ticks_positions.length > 0) {
                        for (var s, o, n, a = 0, h = 1; h < this.options.ticks_positions.length; h++) if (t <= this.options.ticks_positions[h]) {
                            s = this.options.ticks[h - 1], n = this.options.ticks_positions[h - 1], o = this.options.ticks[h], a = this.options.ticks_positions[h];
                            break
                        }
                        var l = (t - n) / (a - n);
                        i = s + l * (o - s), e = !1
                    }
                    var r = e ? this.options.min : 0, p = r + Math.round(i / this.options.step) * this.options.step;
                    return p < this.options.min ? this.options.min : p > this.options.max ? this.options.max : p
                }, toPercentage: function (t) {
                    if (this.options.max === this.options.min) return 0;
                    if (this.options.ticks_positions.length > 0) {
                        for (var i, e, s, o = 0, n = 0; n < this.options.ticks.length; n++) if (t <= this.options.ticks[n]) {
                            i = n > 0 ? this.options.ticks[n - 1] : 0, s = n > 0 ? this.options.ticks_positions[n - 1] : 0, e = this.options.ticks[n], o = this.options.ticks_positions[n];
                            break
                        }
                        if (n > 0) {
                            var a = (t - i) / (e - i);
                            return s + a * (o - s)
                        }
                    }
                    return 100 * (t - this.options.min) / (this.options.max - this.options.min)
                }
            }, logarithmic: {
                toValue: function (t) {
                    var i = 0 === this.options.min ? 0 : Math.log(this.options.min), e = Math.log(this.options.max),
                        s = Math.exp(i + (e - i) * t / 100);
                    return s = this.options.min + Math.round((s - this.options.min) / this.options.step) * this.options.step, s < this.options.min ? this.options.min : s > this.options.max ? this.options.max : s
                }, toPercentage: function (t) {
                    if (this.options.max === this.options.min) return 0;
                    var i = Math.log(this.options.max), e = 0 === this.options.min ? 0 : Math.log(this.options.min),
                        s = 0 === t ? 0 : Math.log(t);
                    return 100 * (s - e) / (i - e)
                }
            }
        };
        if (i = function (t, i) {
            return e.call(this, t, i), this
        }, i.prototype = {
            _init: function () {
            },
            constructor: i,
            defaultOptions: {
                id: "",
                min: 0,
                max: 10,
                step: 1,
                precision: 0,
                orientation: "horizontal",
                value: 5,
                range: !1,
                selection: "before",
                tooltip: "show",
                tooltip_split: !1,
                handle: "round",
                reversed: !1,
                enabled: !0,
                formatter: function (t) {
                    return Array.isArray(t) ? t[0] + " : " + t[1] : t
                },
                natural_arrow_keys: !1,
                ticks: [],
                ticks_positions: [],
                ticks_labels: [],
                ticks_snap_bounds: 0,
                scale: "linear",
                focus: !1,
                tooltip_position: null,
                labelledby: null,
                atio: ""
            },
            getElement: function () {
                return this.sliderElem
            },
            getValue: function () {
                return this.options.range ? this._state.value : this._state.value[0]
            },
            setValue: function (t, i, e) {
                t || (t = 0);
                var s = this.getValue();
                this._state.value = this._validateInputValue(t);
                var o = this._applyPrecision.bind(this);
                this.options.range ? (this._state.value[0] = o(this._state.value[0]), this._state.value[1] = o(this._state.value[1]), this._state.value[0] = Math.max(this.options.min, Math.min(this.options.max, this._state.value[0])), this._state.value[1] = Math.max(this.options.min, Math.min(this.options.max, this._state.value[1]))) : (this._state.value = o(this._state.value), this._state.value = [Math.max(this.options.min, Math.min(this.options.max, this._state.value))], this._addClass(this.handle2, "hide"), "after" === this.options.selection ? this._state.value[1] = this.options.max : this._state.value[1] = this.options.min), this.options.max > this.options.min ? this._state.percentage = [this._toPercentage(this._state.value[0]), this._toPercentage(this._state.value[1]), 100 * this.options.step / (this.options.max - this.options.min)] : this._state.percentage = [0, 0, 100], this._layout();
                var n = this.options.range ? this._state.value : this._state.value[0];
                return this._setDataVal(n), i === !0 && this._trigger("slide", n), s !== n && e === !0 && this._trigger("change", {
                    oldValue: s,
                    newValue: n
                }), this
            },
            destroy: function () {
                this._removeSliderEventHandlers(), this.sliderElem.parentNode.removeChild(this.sliderElem), this.element.style.display = "", this._cleanUpEventCallbacksMap(), this.element.removeAttribute("data"), t && (this._unbindJQueryEventHandlers(), this.$element.removeData("slider"))
            },
            disable: function () {
                return this._state.enabled = !1, this.handle1.removeAttribute("tabindex"), this.handle2.removeAttribute("tabindex"), this._addClass(this.sliderElem, "slider-disabled"), this._trigger("slideDisabled"), this
            },
            enable: function () {
                return this._state.enabled = !0, this.handle1.setAttribute("tabindex", 0), this.handle2.setAttribute("tabindex", 0), this._removeClass(this.sliderElem, "slider-disabled"), this._trigger("slideEnabled"), this
            },
            toggle: function () {
                return this._state.enabled ? this.disable() : this.enable(), this
            },
            isEnabled: function () {
                return this._state.enabled
            },
            on: function (t, i) {
                return this._bindNonQueryEventHandler(t, i), this
            },
            off: function (i, e) {
                t ? (this.$element.off(i, e), this.$sliderElem.off(i, e)) : this._unbindNonQueryEventHandler(i, e)
            },
            getAttribute: function (t) {
                return t ? this.options[t] : this.options
            },
            setAttribute: function (t, i) {
                return this.options[t] = i, this
            },
            refresh: function () {
                return this._removeSliderEventHandlers(), e.call(this, this.element, this.options), t && t.data(this.element, "slider", this), this
            },
            relayout: function () {
                return this._resize(), this._layout(), this
            },
            _removeSliderEventHandlers: function () {
                this.handle1.removeEventListener("keydown", this.handle1Keydown, !1), this.handle2.removeEventListener("keydown", this.handle2Keydown, !1), this.showTooltip && (this.handle1.removeEventListener("focus", this.showTooltip, !1), this.handle2.removeEventListener("focus", this.showTooltip, !1)), this.hideTooltip && (this.handle1.removeEventListener("blur", this.hideTooltip, !1), this.handle2.removeEventListener("blur", this.hideTooltip, !1)), this.showTooltip && this.sliderElem.removeEventListener("mouseenter", this.showTooltip, !1), this.hideTooltip && this.sliderElem.removeEventListener("mouseleave", this.hideTooltip, !1), this.sliderElem.removeEventListener("touchstart", this.touchstart, !1), this.sliderElem.removeEventListener("touchmove", this.touchmove, !1), this.sliderElem.removeEventListener("mousedown", this.mousedown, !1), window.removeEventListener("resize", this.resize, !1)
            },
            _bindNonQueryEventHandler: function (t, i) {
                void 0 === this.eventToCallbackMap[t] && (this.eventToCallbackMap[t] = []), this.eventToCallbackMap[t].push(i)
            },
            _unbindNonQueryEventHandler: function (t, i) {
                var e = this.eventToCallbackMap[t];
                if (void 0 !== e) for (var s = 0; s < e.length; s++) if (e[s] === i) {
                    e.splice(s, 1);
                    break
                }
            },
            _cleanUpEventCallbacksMap: function () {
                for (var t = Object.keys(this.eventToCallbackMap), i = 0; i < t.length; i++) {
                    var e = t[i];
                    this.eventToCallbackMap[e] = null
                }
            },
            _showTooltip: function () {
                this.options.tooltip_split === !1 ? (this._addClass(this.tooltip, "in"), this.tooltip_min.style.display = "none", this.tooltip_max.style.display = "none") : (this._addClass(this.tooltip_min, "in"), this._addClass(this.tooltip_max, "in"), this.tooltip.style.display = "none"), this._state.over = !0
            },
            _hideTooltip: function () {
                this._state.inDrag === !1 && this.alwaysShowTooltip !== !0 && (this._removeClass(this.tooltip, "in"), this._removeClass(this.tooltip_min, "in"), this._removeClass(this.tooltip_max, "in")), this._state.over = !1
            },
            _layout: function () {
                var t;
                if (t = this.options.reversed ? [100 - this._state.percentage[0], this.options.range ? 100 - this._state.percentage[1] : this._state.percentage[1]] : [this._state.percentage[0], this._state.percentage[1]], this.handle1.style[this.stylePos] = t[0] + "%", this.handle1.setAttribute("aria-valuenow", this._state.value[0]), this.handle2.style[this.stylePos] = t[1] + "%", this.handle2.setAttribute("aria-valuenow", this._state.value[1]), Array.isArray(this.options.ticks) && this.options.ticks.length > 0) {
                    var i = "vertical" === this.options.orientation ? "height" : "width",
                        e = "vertical" === this.options.orientation ? "marginTop" : "marginLeft",
                        s = this._state.size / (this.options.ticks.length - 1);
                    if (this.tickLabelContainer) {
                        var o = 0;
                        if (0 === this.options.ticks_positions.length) "vertical" !== this.options.orientation && (this.tickLabelContainer.style[e] = -s / 2 + "px"), o = this.tickLabelContainer.offsetHeight; else for (n = 0; n < this.tickLabelContainer.childNodes.length; n++) this.tickLabelContainer.childNodes[n].offsetHeight > o && (o = this.tickLabelContainer.childNodes[n].offsetHeight);
                        "horizontal" === this.options.orientation && (this.sliderElem.style.marginBottom = o + "px")
                    }
                    for (var n = 0; n < this.options.ticks.length; n++) {
                        var a = this.options.ticks_positions[n] || this._toPercentage(this.options.ticks[n]);
                        this.options.reversed && (a = 100 - a), this.ticks[n].style[this.stylePos] = a + "%", this._removeClass(this.ticks[n], "in-selection"), this.options.range ? a >= t[0] && a <= t[1] && this._addClass(this.ticks[n], "in-selection") : "after" === this.options.selection && a >= t[0] ? this._addClass(this.ticks[n], "in-selection") : "before" === this.options.selection && a <= t[0] && this._addClass(this.ticks[n], "in-selection"), this.tickLabels[n] && (this.tickLabels[n].style[i] = s + "px", "vertical" !== this.options.orientation && void 0 !== this.options.ticks_positions[n] ? (this.tickLabels[n].style.position = "absolute", this.tickLabels[n].style[this.stylePos] = a + "%", this.tickLabels[n].style[e] = -s / 2 + "px") : "vertical" === this.options.orientation && (this.tickLabels[n].style.marginLeft = this.sliderElem.offsetWidth + "px", this.tickLabelContainer.style.marginTop = this.sliderElem.offsetWidth / 2 * -1 + "px"))
                    }
                }
                var h;
                if (this.options.range) {
                    h = this.options.formatter(this._state.value), this._setText(this.tooltipInner, h), this.tooltip.style[this.stylePos] = (t[1] + t[0]) / 2 + "%", "vertical" === this.options.orientation ? this._css(this.tooltip, "margin-top", -this.tooltip.offsetHeight / 2 + "px") : this._css(this.tooltip, "margin-left", -this.tooltip.offsetWidth / 2 + "px"), "vertical" === this.options.orientation ? this._css(this.tooltip, "margin-top", -this.tooltip.offsetHeight / 2 + "px") : this._css(this.tooltip, "margin-left", -this.tooltip.offsetWidth / 2 + "px");
                    var l = this.options.formatter(this._state.value[0]);
                    this._setText(this.tooltipInner_min, l);
                    var r = this.options.formatter(this._state.value[1]);
                    this._setText(this.tooltipInner_max, r), this.tooltip_min.style[this.stylePos] = t[0] + "%", "vertical" === this.options.orientation ? this._css(this.tooltip_min, "margin-top", -this.tooltip_min.offsetHeight / 2 + "px") : this._css(this.tooltip_min, "margin-left", -this.tooltip_min.offsetWidth / 2 + "px"), this.tooltip_max.style[this.stylePos] = t[1] + "%", "vertical" === this.options.orientation ? this._css(this.tooltip_max, "margin-top", -this.tooltip_max.offsetHeight / 2 + "px") : this._css(this.tooltip_max, "margin-left", -this.tooltip_max.offsetWidth / 2 + "px")
                } else h = this.options.formatter(this._state.value[0]), this._setText(this.tooltipInner, h), this.tooltip.style[this.stylePos] = t[0] + "%", "vertical" === this.options.orientation ? this._css(this.tooltip, "margin-top", -this.tooltip.offsetHeight / 2 + "px") : this._css(this.tooltip, "margin-left", -this.tooltip.offsetWidth / 2 + "px");
                if ("vertical" === this.options.orientation) this.trackLow.style.top = "0", this.trackLow.style.height = Math.min(t[0], t[1]) + "%", this.trackSelection.style.top = Math.min(t[0], t[1]) + "%", this.trackSelection.style.height = Math.abs(t[0] - t[1]) + "%", this.trackHigh.style.bottom = "0", this.trackHigh.style.height = 100 - Math.min(t[0], t[1]) - Math.abs(t[0] - t[1]) + "%"; else {
                    this.trackLow.style.left = "0", this.trackLow.style.width = Math.min(t[0], t[1]) + "%", this.trackSelection.style.left = Math.min(t[0], t[1]) + "%", this.trackSelection.style.width = Math.abs(t[0] - t[1]) + "%", this.trackHigh.style.right = "0", this.trackHigh.style.width = 100 - Math.min(t[0], t[1]) - Math.abs(t[0] - t[1]) + "%";
                    var p = this.tooltip_min.getBoundingClientRect(), d = this.tooltip_max.getBoundingClientRect();
                    "bottom" === this.options.tooltip_position ? p.right > d.left ? (this._removeClass(this.tooltip_max, "bottom"), this._addClass(this.tooltip_max, "top"), this.tooltip_max.style.top = "", this.tooltip_max.style.bottom = "22px") : (this._removeClass(this.tooltip_max, "top"), this._addClass(this.tooltip_max, "bottom"), this.tooltip_max.style.top = this.tooltip_min.style.top, this.tooltip_max.style.bottom = "") : p.right > d.left ? (this._removeClass(this.tooltip_max, "top"), this._addClass(this.tooltip_max, "bottom"), this.tooltip_max.style.top = "18px") : (this._removeClass(this.tooltip_max, "bottom"), this._addClass(this.tooltip_max, "top"), this.tooltip_max.style.top = this.tooltip_min.style.top)
                }
            },
            _resize: function (t) {
                this._state.offset = this._offset(this.sliderElem), this._state.size = this.sliderElem[this.sizePos], this._layout()
            },
            _removeProperty: function (t, i) {
                t.style.removeProperty ? t.style.removeProperty(i) : t.style.removeAttribute(i)
            },
            _mousedown: function (t) {
                if (!this._state.enabled) return !1;
                this._state.offset = this._offset(this.sliderElem), this._state.size = this.sliderElem[this.sizePos];
                var i = this._getPercentage(t);
                if (this.options.range) {
                    var e = Math.abs(this._state.percentage[0] - i), s = Math.abs(this._state.percentage[1] - i);
                    this._state.dragged = s > e ? 0 : 1, this._adjustPercentageForRangeSliders(i)
                } else this._state.dragged = 0;
                this._state.percentage[this._state.dragged] = i, this._layout(), this.touchCapable && (document.removeEventListener("touchmove", this.mousemove, !1), document.removeEventListener("touchend", this.mouseup, !1)), this.mousemove && document.removeEventListener("mousemove", this.mousemove, !1), this.mouseup && document.removeEventListener("mouseup", this.mouseup, !1), this.mousemove = this._mousemove.bind(this), this.mouseup = this._mouseup.bind(this), this.touchCapable && (document.addEventListener("touchmove", this.mousemove, !1), document.addEventListener("touchend", this.mouseup, !1)), document.addEventListener("mousemove", this.mousemove, !1), document.addEventListener("mouseup", this.mouseup, !1), this._state.inDrag = !0;
                var o = this._calculateValue();
                return this._trigger("slideStart", o), this._setDataVal(o), this.setValue(o, !1, !0), this._pauseEvent(t), this.options.focus && this._triggerFocusOnHandle(this._state.dragged), !0
            },
            _touchstart: function (t) {
                if (void 0 === t.changedTouches) return void this._mousedown(t);
                var i = t.changedTouches[0];
                this.touchX = i.pageX, this.touchY = i.pageY
            },
            _triggerFocusOnHandle: function (t) {
                0 === t && this.handle1.focus(), 1 === t && this.handle2.focus()
            },
            _keydown: function (t, i) {
                if (!this._state.enabled) return !1;
                var e;
                switch (i.keyCode) {
                    case 37:
                    case 40:
                        e = -1;
                        break;
                    case 39:
                    case 38:
                        e = 1
                }
                if (e) {
                    if (this.options.natural_arrow_keys) {
                        var s = "vertical" === this.options.orientation && !this.options.reversed,
                            o = "horizontal" === this.options.orientation && this.options.reversed;
                        (s || o) && (e = -e)
                    }
                    var n = this._state.value[t] + e * this.options.step;
                    return this.options.range && (n = [t ? this._state.value[0] : n, t ? n : this._state.value[1]]), this._trigger("slideStart", n), this._setDataVal(n), this.setValue(n, !0, !0), this._setDataVal(n), this._trigger("slideStop", n), this._layout(), this._pauseEvent(i), !1
                }
            },
            _pauseEvent: function (t) {
                t.stopPropagation && t.stopPropagation(), t.preventDefault && t.preventDefault(), t.cancelBubble = !0, t.returnValue = !1
            },
            _mousemove: function (t) {
                if (!this._state.enabled) return !1;
                var i = this._getPercentage(t);
                this._adjustPercentageForRangeSliders(i), this._state.percentage[this._state.dragged] = i, this._layout();
                var e = this._calculateValue(!0);
                this._state.atio_element;
                return this.setValue(e, !0, !0), !1
            },
            _touchmove: function (t) {
                if (void 0 !== t.changedTouches) {
                    var i = t.changedTouches[0], e = i.pageX - this.touchX, s = i.pageY - this.touchY;
                    this._state.inDrag || ("vertical" === this.options.orientation && 5 >= e && e >= -5 && (s >= 15 || -15 >= s) ? this._mousedown(t) : 5 >= s && s >= -5 && (e >= 15 || -15 >= e) && this._mousedown(t))
                }
            },
            _adjustPercentageForRangeSliders: function (t) {
                if (this.options.range) {
                    var i = this._getNumDigitsAfterDecimalPlace(t);
                    i = i ? i - 1 : 0;
                    var e = this._applyToFixedAndParseFloat(t, i);
                    0 === this._state.dragged && this._applyToFixedAndParseFloat(this._state.percentage[1], i) < e ? (this._state.percentage[0] = this._state.percentage[1], this._state.dragged = 1) : 1 === this._state.dragged && this._applyToFixedAndParseFloat(this._state.percentage[0], i) > e && (this._state.percentage[1] = this._state.percentage[0], this._state.dragged = 0)
                }
            },
            _mouseup: function () {
                if (!this._state.enabled) return !1;
                this.touchCapable && (document.removeEventListener("touchmove", this.mousemove, !1), document.removeEventListener("touchend", this.mouseup, !1)), document.removeEventListener("mousemove", this.mousemove, !1), document.removeEventListener("mouseup", this.mouseup, !1), this._state.inDrag = !1, this._state.over === !1 && this._hideTooltip();
                var t = this._calculateValue(!0);
                return this._layout(), this._setDataVal(t), this._trigger("slideStop", t), !1
            },
            _calculateValue: function (t) {
                var i;
                if (this.options.range ? (i = [this.options.min, this.options.max], 0 !== this._state.percentage[0] && (i[0] = this._toValue(this._state.percentage[0]), i[0] = this._applyPrecision(i[0])), 100 !== this._state.percentage[1] && (i[1] = this._toValue(this._state.percentage[1]), i[1] = this._applyPrecision(i[1]))) : (i = this._toValue(this._state.percentage[0]), i = parseFloat(i), i = this._applyPrecision(i)), t) {
                    for (var e = [i, 1 / 0], s = 0; s < this.options.ticks.length; s++) {
                        var o = Math.abs(this.options.ticks[s] - i);
                        o <= e[1] && (e = [this.options.ticks[s], o])
                    }
                    if (e[1] <= this.options.ticks_snap_bounds) return e[0]
                }
                return i
            },
            _applyPrecision: function (t) {
                var i = this.options.precision || this._getNumDigitsAfterDecimalPlace(this.options.step);
                return this._applyToFixedAndParseFloat(t, i)
            },
            _getNumDigitsAfterDecimalPlace: function (t) {
                var i = ("" + t).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
                return i ? Math.max(0, (i[1] ? i[1].length : 0) - (i[2] ? +i[2] : 0)) : 0
            },
            _applyToFixedAndParseFloat: function (t, i) {
                var e = t.toFixed(i);
                return parseFloat(e)
            },
            _getPercentage: function (t) {
                !this.touchCapable || "touchstart" !== t.type && "touchmove" !== t.type || (t = t.touches[0]);
                var i = t[this.mousePos], e = this._state.offset[this.stylePos], s = i - e,
                    o = s / this._state.size * 100;
                return o = Math.round(o / this._state.percentage[2]) * this._state.percentage[2], this.options.reversed && (o = 100 - o), Math.max(0, Math.min(100, o))
            },
            _validateInputValue: function (t) {
                if ("number" == typeof t) return t;
                if (Array.isArray(t)) return this._validateArray(t), t;
                throw new Error(s.formatInvalidInputErrorMsg(t))
            },
            _validateArray: function (t) {
                for (var i = 0; i < t.length; i++) {
                    var e = t[i];
                    if ("number" != typeof e) throw new Error(s.formatInvalidInputErrorMsg(e))
                }
            },
            _setDataVal: function (t) {
                this.element.setAttribute("data-value", t), this.element.setAttribute("value", t), this.element.value = t
            },
            _trigger: function (i, e) {
                e = e || 0 === e ? e : void 0;
                var s = this.eventToCallbackMap[i];
                if (s && s.length) for (var o = 0; o < s.length; o++) {
                    var n = s[o];
                    n(e)
                }
                t && this._triggerJQueryEvent(i, e)
            },
            _triggerJQueryEvent: function (t, i) {
                var e = {type: t, value: i};
                this.$element.trigger(e), this.$sliderElem.trigger(e)
            },
            _unbindJQueryEventHandlers: function () {
                this.$element.off(), this.$sliderElem.off()
            },
            _setText: function (t, i) {
                "undefined" != typeof t.textContent ? t.textContent = i : "undefined" != typeof t.innerText && (t.innerText = i)
            },
            _removeClass: function (t, i) {
                for (var e = i.split(" "), s = t.className, o = 0; o < e.length; o++) {
                    var n = e[o], a = new RegExp("(?:\\s|^)" + n + "(?:\\s|$)");
                    s = s.replace(a, " ")
                }
                t.className = s.trim()
            },
            _addClass: function (t, i) {
                for (var e = i.split(" "), s = t.className, o = 0; o < e.length; o++) {
                    var n = e[o], a = new RegExp("(?:\\s|^)" + n + "(?:\\s|$)"), h = a.test(s);
                    h || (s += " " + n)
                }
                t.className = s.trim()
            },
            _offsetLeft: function (t) {
                return t.getBoundingClientRect().left
            },
            _offsetTop: function (t) {
                for (var i = t.offsetTop; (t = t.offsetParent) && !isNaN(t.offsetTop);) i += t.offsetTop, "BODY" !== t.tagName && (i -= t.scrollTop);
                return i
            },
            _offset: function (t) {
                return {left: this._offsetLeft(t), top: this._offsetTop(t)}
            },
            _css: function (i, e, s) {
                if (t) t.style(i, e, s); else {
                    var o = e.replace(/^-ms-/, "ms-").replace(/-([\da-z])/gi, function (t, i) {
                        return i.toUpperCase()
                    });
                    i.style[o] = s
                }
            },
            _toValue: function (t) {
                return this.options.scale.toValue.apply(this, [t])
            },
            _toPercentage: function (t) {
                return this.options.scale.toPercentage.apply(this, [t])
            },
            _setTooltipPosition: function () {
                var t = [this.tooltip, this.tooltip_min, this.tooltip_max];
                if ("vertical" === this.options.orientation) {
                    var i = this.options.tooltip_position || "right", e = "left" === i ? "right" : "left";
                    t.forEach(function (t) {
                        this._addClass(t, i), t.style[e] = "100%"
                    }.bind(this))
                } else "bottom" === this.options.tooltip_position ? t.forEach(function (t) {
                    this._addClass(t, "bottom"), t.style.top = "22px"
                }.bind(this)) : t.forEach(function (t) {
                    this._addClass(t, "top"), t.style.top = -this.tooltip.outerHeight - 14 + "px"
                }.bind(this))
            }
        }, t) {
            var n = t.fn.slider ? "bootstrapSlider" : "slider";
            t.bridget(n, i), t(function () {
                t("input[data-provide=slider]")[n]()
            })
        }
    }(t), i
});

/*
 * jQuery applink
 */
!function (t, e, n, o) {
    var i = "applink", p = {popup: "auto", desktop: !1, delegate: null, timeout: 1500, data: i}, d = !1,
        u = navigator.userAgent, a = null !== u.match(/iPad/i),
        r = !a && (null !== u.match(/iPhone/i) || null !== u.match(/iPod/i)), s = a || r,
        f = !s && null !== u.match(/android/i), c = s || f, l = function (t, e) {
            return e.href = t.attr("href"), e.applink = t.data(e.data), e.popup = t.data("popup"), e.desktop = t.data("desktop"), e.desktop = "undefined" != typeof e.desktop && e.desktop ? "true" === e.desktop.toString() : p.desktop, e.enabled = c || e.desktop ? e.applink : !1, e.enabled = "undefined" != typeof e.enabled && e.enabled ? !0 : !1, e.popup = "undefined" != typeof e.popup && e.popup ? "false" === e.popup.toString() ? !1 : e.popup : p.popup, e.popup = "auto" === e.popup && /^https?:\/\/(www\.)?(facebook|twitter)\.com/i.test(e.href) ? !0 : "auto" !== e.popup && e.popup ? !0 : !1, e
        }, h = function (t) {
            setTimeout(function () {
                g() ? d && d.close() : y(t)
            }, t.timeout), e.location = t.applink
        }, g = function () {
            return "undefined" != typeof n.hidden ? n.hidden : "undefined" != typeof n.mozHidden ? n.mozHidden : "undefined" != typeof n.msHidden ? n.msHidden : "undefined" != typeof n.webkitHidden ? n.webkitHidden : !1
        }, y = function (t) {
            return t.popup ? m(t) : (d && !d.closed && d.close(), void (e.location = t.href))
        }, m = function (t) {
            if (d && !d.closed) return d.location.replace(t.href), d.focus(), d;
            var n = screen.width > 620 ? 600 : screen.width, o = screen.height > 300 ? 280 : screen.height,
                p = screen.width / 2 - n / 2, u = screen.height / 2 - o / 2,
                a = "location=no,menubar=no,status=no,toolbar=no,scrollbars=no,directories=no,copyhistory=no,width=" + n + ",height=" + o + ",top=" + u + ",left=" + p;
            return d = e.open(t.href, i, a), d.focus(), d
        }, k = function (e, n) {
            this.element = e, this.settings = t.extend({}, p, n), this.init()
        };
    k.prototype = {
        init: function () {
            var e = t(this.element), n = this;
            e.on("click." + i, this.settings.delegate, function (e) {
                e.preventDefault();
                var o = l(t(this), n.settings);
                return o.enabled ? void h(o) : y(o)
            })
        }, destroy: function () {
            t(this.element).off("." + i)
        }
    }, t.fn[i] = function (e) {
        if (e === o || "object" == typeof e) return this.each(function () {
            t.data(this, "plugin_" + i) || t.data(this, "plugin_" + i, new k(this, e))
        });
        if ("string" != typeof e || "_" === e[0] || "init" === e) return !0;
        var n, p = arguments;
        return this.each(function () {
            var o = t.data(this, "plugin_" + i);
            o instanceof k && "function" == typeof o[e] && (n = o[e].apply(o, Array.prototype.slice.call(p, 1))), "destroy" === e && t.data(this, "plugin_" + i, null)
        }), n !== o ? n : this
    }
}(jQuery, window, document);

function isInt(val) {
    var intRegex = /^-?\d+$/;
    if (!intRegex.test(val))
        return false;

    var intVal = parseInt(val, 10);
    return parseFloat(val) == intVal && !isNaN(intVal);
}

jQuery.fn.eqHeights = function (options) {
    var defaults = {
        child: false,
        parentSelector: null
    };
    var options = jQuery.extend(defaults, options);

    var grand_parent = jQuery(this).parent().parent().parent();

    if (grand_parent.hasClass('carousel-inner') || grand_parent.hasClass('tab-pane')) {
        return;
    }

    var el = jQuery(this);
    if (el.length > 0 && !el.data('eqHeights')) {
        jQuery(window).bind('resize.eqHeights', function () {
            el.eqHeights();
        });
        el.data('eqHeights', true);
    }

    if (options.child && options.child.length > 0) {
        var elmtns = jQuery(options.child, this);
    } else {
        var elmtns = jQuery(this).children();
    }

    var prevTop = 0;
    var max_height = 0;
    var elements = [];
    var parentEl;
    elmtns.height('auto').each(function () {

        if (options.parentSelector && parentEl !== jQuery(this).parents(options.parentSelector).get(0)) {
            jQuery(elements).height(max_height);
            max_height = 0;
            prevTop = 0;
            elements = [];
            parentEl = jQuery(this).parents(options.parentSelector).get(0);
        }

        var thisTop = this.offsetTop;

        if (prevTop > 0 && prevTop != thisTop) {
            jQuery(elements).height(max_height);
            max_height = jQuery(this).height();
            elements = [];
        }
        max_height = Math.max(max_height, jQuery(this).height());

        prevTop = this.offsetTop;
        elements.push(this);
    });

    if (max_height > 250) {
        jQuery(elements).height(max_height);
    }
};

var filter_page_reset = false;

/*
 * jQuery ready
 */
jQuery(document).ready(function () {
    jQuery('a[data-applink]').applink();
    jQuery('iframe[src*="youtube.com"], iframe[src*="youtube-nocookie.com"], iframe[src*="vimeo.com"], iframe[src*="google.com/maps"]').wrap('<div class="embed-responsive embed-responsive-16by9" />');
    jQuery('#comments_reply .form-submit input[type="submit"]').addClass('btn btn-at pull-right').after('<div class="clearfix"></div>');

    jQuery('#content p').each(function () {
        var $this = jQuery(this);
        if ($this.html().replace(/\s| /g, '').length == 0) $this.addClass('empty');
    });

    jQuery('.bt-slider').each(function (e) {
        var curSlider = jQuery(this);

        jQuery(this).slider({
            formatter: function (value) {
                if (curSlider.attr('data-slider-label')) {
                    if (Array.isArray(value)) {
                        return value[0] + curSlider.attr('data-slider-label') + " - " + value[1] + curSlider.attr('data-slider-label');
                    } else {
                        return value;
                    }
                } else {
                    return value;
                }
            }
        });
    });

    jQuery("#navigation .dropdown").on("show.bs.dropdown", function (event) {
        var icon = jQuery(this).find('.extra-toggle:first').find('.glyphicon');
        icon.removeClass('glyphicon-plus').addClass('glyphicon-minus');
    });

    jQuery("#navigation .dropdown").on("hidden.bs.dropdown", function (event) {
        var icon = jQuery(this).find('.extra-toggle:first').find('.glyphicon');
        icon.removeClass('glyphicon-minus').addClass('glyphicon-plus');
    });

    jQuery("#navigation .menu-item-has-children ul .extra-toggle").on("click", function (event) {
        var icon = jQuery(this).find('.glyphicon');
        console.log(icon);
        if (icon.hasClass('glyphicon-plus')) {
            icon.removeClass('glyphicon-plus').addClass('glyphicon-minus');
        } else {
            icon.removeClass('glyphicon-minus').addClass('glyphicon-plus');
        }
    });

    jQuery('.product-grid-hover .caption-hover-img a[data-big]').bind('mouseover click', function (e) {
        var image_src = jQuery(this).attr('data-big');
        var image_target = jQuery(this).closest('.product-grid-hover').find('.img-grid-wrapper a img');
        var image_target_src = image_target.attr('src');

        jQuery(this).closest('ul').find('a').removeClass('active');
        jQuery(this).addClass('active');
        jQuery(image_target).attr('src', image_src).attr('srcset', image_src);

        e.preventDefault();
    });

    jQuery('#productGallery ol.carousel-indicators').on("touchstart", "li", function () {
        var slide = jQuery(this).attr('data-slide-to');

        jQuery('#productGallery ol.carousel-indicators li.active').removeClass("active");
        jQuery(this).addClass("active");
        jQuery('#productGallery').carousel(parseInt(slide));
    });

    jQuery('#content .eq').eqHeights({parentSelector: '.row'});

    jQuery('a[data-applink]').applink();

    // product filter
    jQuery('form.filterform[data-ajax="true"] button[type="submit"]').on('click', function () {
        filter_page_reset = true;
    });

    jQuery('form.filterform[data-ajax="true"]').submit(function () {
        if (filter_page_reset) {
            jQuery(this).parent().find('input[name="paged"]').val('1');
        }

        var form_data = jQuery(this).serialize();
        var filter_id = jQuery(this).data('id');
        var source_id = jQuery(this).data('source-id');
        var button = jQuery(this).find('button[type="submit"]');
        var results = jQuery('.filter-results[data-form-id="' + filter_id + '"]');

        jQuery(document).trigger('at_filter_submit', form_data);

        if (results.length == 0) {
            var target = jQuery('#main #content');

            if (jQuery('#main #content .product-listing').length) {
                target = jQuery('#main #content .product-listing');
            }

            target.html('<div id="filter-results-' + filter_id + '" class="filter-results filter-results-ajaxify" data-form-id="' + filter_id + '"></div>');
            var results = jQuery('.filter-results[data-form-id="' + filter_id + '"]');
        }

        button.append(' <i class="fa fa-spinner fa-spin"></i>');
        results.addClass('filter-loading');

        jQuery.ajax({
            type: 'POST',
            url: ajaxurl,
            data: form_data + '&action=product_filter_ajax&source_id=' + source_id + '&filter_id=' + filter_id,
            success: function (data) {
                results.html(data);
                button.find('i').remove();
                results.removeClass('filter-loading');

                jQuery(document).trigger('at_filter_submit_success', form_data);

                // check user filter ordering
                if (jQuery('.result-filter').length) {
                    var current_layout = 'grid';

                    if (results.find('.product-list').length) {
                        current_layout = 'list';
                    }

                    jQuery('.result-filter a[href*="layout"]').removeClass('active');
                    jQuery('.result-filter a[data-value="' + current_layout + '"]').addClass('active');
                }
            }
        });

        return false;
    });

    // product filter pagination
    jQuery(document.body).on('click', '.filter-results .pagination li a', function (e) {
        var form_id = jQuery(this).closest('.filter-results').data('form-id');
        var form = jQuery('form.filterform[data-id="' + form_id + '"]');
        var page = jQuery(this).data('page');

        filter_page_reset = false;
        form.find('input[name="paged"]').val(page);
        form.submit();

        jQuery('html,body').animate({
            scrollTop: form.offset().top - 100 + 'px'
        }, 300);

        return false;
    });

    // comment reply, privacy
    if (jQuery('#respond.comment-respond input[name="user_check"]').length > 0) {
        jQuery('body:not(.logged-in) #comments_reply .form-submit input[type="submit"]').attr('disabled', true);
        jQuery('#respond.comment-respond input[name="user_check"]').on('change', function (e) {
            if (this.checked) {
                jQuery('#comments_reply .form-submit input[type="submit"]').attr('disabled', false);
            } else {
                jQuery('#comments_reply .form-submit input[type="submit"]').attr('disabled', true);
            }
        });
    }
});

/**
 * Cookie Bar
 */

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }

    return "";
}

function accept_cookie() {
    var now = new Date();
    var time = now.getTime();
    time += 3122064000 * 1000;
    now.setTime(time);
    document.cookie = "allow_cookie=1;expires=" + now.toUTCString() + ";path=/";
    jQuery('.cookie-bar').slideToggle('slow');
}

function display_cookie_info() {
    if (getCookie('allow_cookie') != '1') {
        jQuery('.cookie-bar').slideToggle('slow');
    }
}

jQuery(document).ready(function () {
    if (jQuery('.cookie-bar').length > 0) {
        display_cookie_info();

        jQuery('#cookie_btn').on('click', function () {
            accept_cookie();
        });

        if (getCookie('allow_cookie') != '1') {
            jQuery(window).scroll(function () {
                var cookiebox = jQuery('.cookie-bar');
                var footer_top = parseFloat(jQuery('#footer').offset().top);
                var scroll_offset_y = jQuery(window).scrollTop() + jQuery(window).height();
                var cookiebox_bottom = cookiebox.offset().top + cookiebox.outerHeight(true);
                if (footer_top < scroll_offset_y) {
                    var bottom_offset = Math.floor((scroll_offset_y - footer_top));
                    jQuery('.cookie-bar').css('bottom', bottom_offset + 'px');
                } else {
                    jQuery('.cookie-bar').css('bottom', '0');
                }
            });
        }
    }
});

/*
 * Social JS
 */
function socialp(elem, m) {
    if (m == 'twitter') {
        var desc = '';
        var el, els = document.getElementsByTagName("meta");
        var i = els.length;
        while (i--) {
            el = els[i];
            if (el.getAttribute("property") == "og:title") {
                desc = el.content;
                break;
            }
        }
        var creator = "";
        if (document.getElementsByName("twitter:creator").length) {
            creator = document.getElementsByName("twitter:creator")[0].content;
        }
        creator = creator.replace('@', '');
        elem.href += "&text=" + encodeURIComponent(desc) + "&via=" + creator + "&related=" + creator;
    }

    if (m == 'pinterest') {
        var image = '';
        var el, els = document.getElementsByTagName("meta");
        var i = els.length;
        while (i--) {
            el = els[i];
            if (el.getAttribute("property") == "og:image") {
                image = el.content;
                break;
            }
        }
        elem.href += "&media=" + image;
    }

    elem = window.open(elem.href, "Teile diese Seite", "width=600,height=500,resizable=yes");
    elem.moveTo(screen.width / 2 - 300, screen.height / 2 - 450);
    elem.focus()
}

/*
 * TO TOP Smooth Scroll
 */
jQuery(function () {
    // ToTop Smooth Scroll
    jQuery('a.totop').click(function () {
        jQuery('html,body').animate({
            scrollTop: 0
        }, 1000);
        return false;
    });
});

/*
 * OPEN TAB
 */
jQuery(function () {
    // ToTop Smooth Scroll
    jQuery('a.open-tab').click(function () {
        var target = jQuery(this).data('target');
        var tab = jQuery('a[aria-controls="' + target + '"]');
        tab.tab('show');

        jQuery('html,body').animate({
            scrollTop: tab.offset().top - 100 + 'px'
        }, 1000);
        return false;
    });
});

/*
 * Smooth Scroll
 */
jQuery(function () {
    // ToTop Smooth Scroll
    jQuery('a.smoothscroll').click(function () {
        var target = jQuery(this.hash);
        var offset = jQuery(this).data('offset');
        target = target.length ? target : jQuery('[name=' + this.hash.slice(1) + ']');
        if (target.length) {
            jQuery('html,body').animate({
                scrollTop: target.offset().top - offset
            }, 1000);
            return false;
        }
    });
});

/*
 * Navigation Dropdown Script
 */
(function ($) {
    $(document).ready(function () {
        $('.navbar ul.dropdown-menu [data-toggle=dropdown]').on('click', function (event) {
            event.preventDefault();
            event.stopPropagation();
            $(this).parent().siblings().removeClass('open');
            $(this).parent().toggleClass('open');
        });
    });
})(jQuery);


/*
 * Carousel Swipe
 */
(function (a) {
    if (typeof define === "function" && define.amd && define.amd.jQuery) {
        define(["jquery"], a)
    } else {
        a(jQuery)
    }
}(function (f) {
    var p = "left", o = "right", e = "up", x = "down", c = "in", z = "out", m = "none", s = "auto", l = "swipe",
        t = "pinch", A = "tap", j = "doubletap", b = "longtap", y = "hold", D = "horizontal", u = "vertical", i = "all",
        r = 10, g = "start", k = "move", h = "end", q = "cancel", a = "ontouchstart" in window,
        v = window.navigator.msPointerEnabled && !window.navigator.pointerEnabled,
        d = window.navigator.pointerEnabled || window.navigator.msPointerEnabled, B = "TouchSwipe";
    var n = {
        fingers: 1,
        threshold: 75,
        cancelThreshold: null,
        pinchThreshold: 20,
        maxTimeThreshold: null,
        fingerReleaseThreshold: 250,
        longTapThreshold: 500,
        doubleTapThreshold: 200,
        swipe: null,
        swipeLeft: null,
        swipeRight: null,
        swipeUp: null,
        swipeDown: null,
        swipeStatus: null,
        pinchIn: null,
        pinchOut: null,
        pinchStatus: null,
        click: null,
        tap: null,
        doubleTap: null,
        longTap: null,
        hold: null,
        triggerOnTouchEnd: true,
        triggerOnTouchLeave: false,
        allowPageScroll: "auto",
        fallbackToMouseEvents: true,
        excludedElements: "label, button, input, select, textarea, a, .noSwipe",
        preventDefaultEvents: true
    };
    f.fn.swipe = function (G) {
        var F = f(this), E = F.data(B);
        if (E && typeof G === "string") {
            if (E[G]) {
                return E[G].apply(this, Array.prototype.slice.call(arguments, 1))
            } else {
                f.error("Method " + G + " does not exist on jQuery.swipe")
            }
        } else {
            if (!E && (typeof G === "object" || !G)) {
                return w.apply(this, arguments)
            }
        }
        return F
    };
    f.fn.swipe.defaults = n;
    f.fn.swipe.phases = {PHASE_START: g, PHASE_MOVE: k, PHASE_END: h, PHASE_CANCEL: q};
    f.fn.swipe.directions = {LEFT: p, RIGHT: o, UP: e, DOWN: x, IN: c, OUT: z};
    f.fn.swipe.pageScroll = {NONE: m, HORIZONTAL: D, VERTICAL: u, AUTO: s};
    f.fn.swipe.fingers = {ONE: 1, TWO: 2, THREE: 3, ALL: i};

    function w(E) {
        if (E && (E.allowPageScroll === undefined && (E.swipe !== undefined || E.swipeStatus !== undefined))) {
            E.allowPageScroll = m
        }
        if (E.click !== undefined && E.tap === undefined) {
            E.tap = E.click
        }
        if (!E) {
            E = {}
        }
        E = f.extend({}, f.fn.swipe.defaults, E);
        return this.each(function () {
            var G = f(this);
            var F = G.data(B);
            if (!F) {
                F = new C(this, E);
                G.data(B, F)
            }
        })
    }

    function C(a4, av) {
        var az = (a || d || !av.fallbackToMouseEvents),
            J = az ? (d ? (v ? "MSPointerDown" : "pointerdown") : "touchstart") : "mousedown",
            ay = az ? (d ? (v ? "MSPointerMove" : "pointermove") : "touchmove") : "mousemove",
            U = az ? (d ? (v ? "MSPointerUp" : "pointerup") : "touchend") : "mouseup", S = az ? null : "mouseleave",
            aD = (d ? (v ? "MSPointerCancel" : "pointercancel") : "touchcancel");
        var ag = 0, aP = null, ab = 0, a1 = 0, aZ = 0, G = 1, aq = 0, aJ = 0, M = null;
        var aR = f(a4);
        var Z = "start";
        var W = 0;
        var aQ = null;
        var T = 0, a2 = 0, a5 = 0, ad = 0, N = 0;
        var aW = null, af = null;
        try {
            aR.bind(J, aN);
            aR.bind(aD, a9)
        } catch (ak) {
            f.error("events not supported " + J + "," + aD + " on jQuery.swipe")
        }
        this.enable = function () {
            aR.bind(J, aN);
            aR.bind(aD, a9);
            return aR
        };
        this.disable = function () {
            aK();
            return aR
        };
        this.destroy = function () {
            aK();
            aR.data(B, null);
            aR = null
        };
        this.option = function (bc, bb) {
            if (av[bc] !== undefined) {
                if (bb === undefined) {
                    return av[bc]
                } else {
                    av[bc] = bb
                }
            } else {
                f.error("Option " + bc + " does not exist on jQuery.swipe.options")
            }
            return null
        };

        function aN(bd) {
            if (aB()) {
                return
            }
            if (f(bd.target).closest(av.excludedElements, aR).length > 0) {
                return
            }
            var be = bd.originalEvent ? bd.originalEvent : bd;
            var bc, bb = a ? be.touches[0] : be;
            Z = g;
            if (a) {
                W = be.touches.length
            } else {
                bd.preventDefault()
            }
            ag = 0;
            aP = null;
            aJ = null;
            ab = 0;
            a1 = 0;
            aZ = 0;
            G = 1;
            aq = 0;
            aQ = aj();
            M = aa();
            R();
            if (!a || (W === av.fingers || av.fingers === i) || aX()) {
                ai(0, bb);
                T = at();
                if (W == 2) {
                    ai(1, be.touches[1]);
                    a1 = aZ = au(aQ[0].start, aQ[1].start)
                }
                if (av.swipeStatus || av.pinchStatus) {
                    bc = O(be, Z)
                }
            } else {
                bc = false
            }
            if (bc === false) {
                Z = q;
                O(be, Z);
                return bc
            } else {
                if (av.hold) {
                    af = setTimeout(f.proxy(function () {
                        aR.trigger("hold", [be.target]);
                        if (av.hold) {
                            bc = av.hold.call(aR, be, be.target)
                        }
                    }, this), av.longTapThreshold)
                }
                ao(true)
            }
            return null
        }

        function a3(be) {
            var bh = be.originalEvent ? be.originalEvent : be;
            if (Z === h || Z === q || am()) {
                return
            }
            var bd, bc = a ? bh.touches[0] : bh;
            var bf = aH(bc);
            a2 = at();
            if (a) {
                W = bh.touches.length
            }
            if (av.hold) {
                clearTimeout(af)
            }
            Z = k;
            if (W == 2) {
                if (a1 == 0) {
                    ai(1, bh.touches[1]);
                    a1 = aZ = au(aQ[0].start, aQ[1].start)
                } else {
                    aH(bh.touches[1]);
                    aZ = au(aQ[0].end, aQ[1].end);
                    aJ = ar(aQ[0].end, aQ[1].end)
                }
                G = a7(a1, aZ);
                aq = Math.abs(a1 - aZ)
            }
            if ((W === av.fingers || av.fingers === i) || !a || aX()) {
                aP = aL(bf.start, bf.end);
                al(be, aP);
                ag = aS(bf.start, bf.end);
                ab = aM();
                aI(aP, ag);
                if (av.swipeStatus || av.pinchStatus) {
                    bd = O(bh, Z)
                }
                if (!av.triggerOnTouchEnd || av.triggerOnTouchLeave) {
                    var bb = true;
                    if (av.triggerOnTouchLeave) {
                        var bg = aY(this);
                        bb = E(bf.end, bg)
                    }
                    if (!av.triggerOnTouchEnd && bb) {
                        Z = aC(k)
                    } else {
                        if (av.triggerOnTouchLeave && !bb) {
                            Z = aC(h)
                        }
                    }
                    if (Z == q || Z == h) {
                        O(bh, Z)
                    }
                }
            } else {
                Z = q;
                O(bh, Z)
            }
            if (bd === false) {
                Z = q;
                O(bh, Z)
            }
        }

        function L(bb) {
            var bc = bb.originalEvent;
            if (a) {
                if (bc.touches.length > 0) {
                    F();
                    return true
                }
            }
            if (am()) {
                W = ad
            }
            a2 = at();
            ab = aM();
            if (ba() || !an()) {
                Z = q;
                O(bc, Z)
            } else {
                if (av.triggerOnTouchEnd || (av.triggerOnTouchEnd == false && Z === k)) {
                    bb.preventDefault();
                    Z = h;
                    O(bc, Z)
                } else {
                    if (!av.triggerOnTouchEnd && a6()) {
                        Z = h;
                        aF(bc, Z, A)
                    } else {
                        if (Z === k) {
                            Z = q;
                            O(bc, Z)
                        }
                    }
                }
            }
            ao(false);
            return null
        }

        function a9() {
            W = 0;
            a2 = 0;
            T = 0;
            a1 = 0;
            aZ = 0;
            G = 1;
            R();
            ao(false)
        }

        function K(bb) {
            var bc = bb.originalEvent;
            if (av.triggerOnTouchLeave) {
                Z = aC(h);
                O(bc, Z)
            }
        }

        function aK() {
            aR.unbind(J, aN);
            aR.unbind(aD, a9);
            aR.unbind(ay, a3);
            aR.unbind(U, L);
            if (S) {
                aR.unbind(S, K)
            }
            ao(false)
        }

        function aC(bf) {
            var be = bf;
            var bd = aA();
            var bc = an();
            var bb = ba();
            if (!bd || bb) {
                be = q
            } else {
                if (bc && bf == k && (!av.triggerOnTouchEnd || av.triggerOnTouchLeave)) {
                    be = h
                } else {
                    if (!bc && bf == h && av.triggerOnTouchLeave) {
                        be = q
                    }
                }
            }
            return be
        }

        function O(bd, bb) {
            var bc = undefined;
            if ((I() || V()) || (P() || aX())) {
                if (I() || V()) {
                    bc = aF(bd, bb, l)
                }
                if ((P() || aX()) && bc !== false) {
                    bc = aF(bd, bb, t)
                }
            } else {
                if (aG() && bc !== false) {
                    bc = aF(bd, bb, j)
                } else {
                    if (ap() && bc !== false) {
                        bc = aF(bd, bb, b)
                    } else {
                        if (ah() && bc !== false) {
                            bc = aF(bd, bb, A)
                        }
                    }
                }
            }
            if (bb === q) {
                a9(bd)
            }
            if (bb === h) {
                if (a) {
                    if (bd.touches.length == 0) {
                        a9(bd)
                    }
                } else {
                    a9(bd)
                }
            }
            return bc
        }

        function aF(be, bb, bd) {
            var bc = undefined;
            if (bd == l) {
                aR.trigger("swipeStatus", [bb, aP || null, ag || 0, ab || 0, W, aQ]);
                if (av.swipeStatus) {
                    bc = av.swipeStatus.call(aR, be, bb, aP || null, ag || 0, ab || 0, W, aQ);
                    if (bc === false) {
                        return false
                    }
                }
                if (bb == h && aV()) {
                    aR.trigger("swipe", [aP, ag, ab, W, aQ]);
                    if (av.swipe) {
                        bc = av.swipe.call(aR, be, aP, ag, ab, W, aQ);
                        if (bc === false) {
                            return false
                        }
                    }
                    switch (aP) {
                        case p:
                            aR.trigger("swipeLeft", [aP, ag, ab, W, aQ]);
                            if (av.swipeLeft) {
                                bc = av.swipeLeft.call(aR, be, aP, ag, ab, W, aQ)
                            }
                            break;
                        case o:
                            aR.trigger("swipeRight", [aP, ag, ab, W, aQ]);
                            if (av.swipeRight) {
                                bc = av.swipeRight.call(aR, be, aP, ag, ab, W, aQ)
                            }
                            break;
                        case e:
                            aR.trigger("swipeUp", [aP, ag, ab, W, aQ]);
                            if (av.swipeUp) {
                                bc = av.swipeUp.call(aR, be, aP, ag, ab, W, aQ)
                            }
                            break;
                        case x:
                            aR.trigger("swipeDown", [aP, ag, ab, W, aQ]);
                            if (av.swipeDown) {
                                bc = av.swipeDown.call(aR, be, aP, ag, ab, W, aQ)
                            }
                            break
                    }
                }
            }
            if (bd == t) {
                aR.trigger("pinchStatus", [bb, aJ || null, aq || 0, ab || 0, W, G, aQ]);
                if (av.pinchStatus) {
                    bc = av.pinchStatus.call(aR, be, bb, aJ || null, aq || 0, ab || 0, W, G, aQ);
                    if (bc === false) {
                        return false
                    }
                }
                if (bb == h && a8()) {
                    switch (aJ) {
                        case c:
                            aR.trigger("pinchIn", [aJ || null, aq || 0, ab || 0, W, G, aQ]);
                            if (av.pinchIn) {
                                bc = av.pinchIn.call(aR, be, aJ || null, aq || 0, ab || 0, W, G, aQ)
                            }
                            break;
                        case z:
                            aR.trigger("pinchOut", [aJ || null, aq || 0, ab || 0, W, G, aQ]);
                            if (av.pinchOut) {
                                bc = av.pinchOut.call(aR, be, aJ || null, aq || 0, ab || 0, W, G, aQ)
                            }
                            break
                    }
                }
            }
            if (bd == A) {
                if (bb === q || bb === h) {
                    clearTimeout(aW);
                    clearTimeout(af);
                    if (Y() && !H()) {
                        N = at();
                        aW = setTimeout(f.proxy(function () {
                            N = null;
                            aR.trigger("tap", [be.target]);
                            if (av.tap) {
                                bc = av.tap.call(aR, be, be.target)
                            }
                        }, this), av.doubleTapThreshold)
                    } else {
                        N = null;
                        aR.trigger("tap", [be.target]);
                        if (av.tap) {
                            bc = av.tap.call(aR, be, be.target)
                        }
                    }
                }
            } else {
                if (bd == j) {
                    if (bb === q || bb === h) {
                        clearTimeout(aW);
                        N = null;
                        aR.trigger("doubletap", [be.target]);
                        if (av.doubleTap) {
                            bc = av.doubleTap.call(aR, be, be.target)
                        }
                    }
                } else {
                    if (bd == b) {
                        if (bb === q || bb === h) {
                            clearTimeout(aW);
                            N = null;
                            aR.trigger("longtap", [be.target]);
                            if (av.longTap) {
                                bc = av.longTap.call(aR, be, be.target)
                            }
                        }
                    }
                }
            }
            return bc
        }

        function an() {
            var bb = true;
            if (av.threshold !== null) {
                bb = ag >= av.threshold
            }
            return bb
        }

        function ba() {
            var bb = false;
            if (av.cancelThreshold !== null && aP !== null) {
                bb = (aT(aP) - ag) >= av.cancelThreshold
            }
            return bb
        }

        function ae() {
            if (av.pinchThreshold !== null) {
                return aq >= av.pinchThreshold
            }
            return true
        }

        function aA() {
            var bb;
            if (av.maxTimeThreshold) {
                if (ab >= av.maxTimeThreshold) {
                    bb = false
                } else {
                    bb = true
                }
            } else {
                bb = true
            }
            return bb
        }

        function al(bb, bc) {
            if (av.preventDefaultEvents === false) {
                return
            }
            if (av.allowPageScroll === m) {
                bb.preventDefault()
            } else {
                var bd = av.allowPageScroll === s;
                switch (bc) {
                    case p:
                        if ((av.swipeLeft && bd) || (!bd && av.allowPageScroll != D)) {
                            bb.preventDefault()
                        }
                        break;
                    case o:
                        if ((av.swipeRight && bd) || (!bd && av.allowPageScroll != D)) {
                            bb.preventDefault()
                        }
                        break;
                    case e:
                        if ((av.swipeUp && bd) || (!bd && av.allowPageScroll != u)) {
                            bb.preventDefault()
                        }
                        break;
                    case x:
                        if ((av.swipeDown && bd) || (!bd && av.allowPageScroll != u)) {
                            bb.preventDefault()
                        }
                        break
                }
            }
        }

        function a8() {
            var bc = aO();
            var bb = X();
            var bd = ae();
            return bc && bb && bd
        }

        function aX() {
            return !!(av.pinchStatus || av.pinchIn || av.pinchOut)
        }

        function P() {
            return !!(a8() && aX())
        }

        function aV() {
            var be = aA();
            var bg = an();
            var bd = aO();
            var bb = X();
            var bc = ba();
            var bf = !bc && bb && bd && bg && be;
            return bf
        }

        function V() {
            return !!(av.swipe || av.swipeStatus || av.swipeLeft || av.swipeRight || av.swipeUp || av.swipeDown)
        }

        function I() {
            return !!(aV() && V())
        }

        function aO() {
            return ((W === av.fingers || av.fingers === i) || !a)
        }

        function X() {
            return aQ[0].end.x !== 0
        }

        function a6() {
            return !!(av.tap)
        }

        function Y() {
            return !!(av.doubleTap)
        }

        function aU() {
            return !!(av.longTap)
        }

        function Q() {
            if (N == null) {
                return false
            }
            var bb = at();
            return (Y() && ((bb - N) <= av.doubleTapThreshold))
        }

        function H() {
            return Q()
        }

        function ax() {
            return ((W === 1 || !a) && (isNaN(ag) || ag < av.threshold))
        }

        function a0() {
            return ((ab > av.longTapThreshold) && (ag < r))
        }

        function ah() {
            return !!(ax() && a6())
        }

        function aG() {
            return !!(Q() && Y())
        }

        function ap() {
            return !!(a0() && aU())
        }

        function F() {
            a5 = at();
            ad = event.touches.length + 1
        }

        function R() {
            a5 = 0;
            ad = 0
        }

        function am() {
            var bb = false;
            if (a5) {
                var bc = at() - a5;
                if (bc <= av.fingerReleaseThreshold) {
                    bb = true
                }
            }
            return bb
        }

        function aB() {
            return !!(aR.data(B + "_intouch") === true)
        }

        function ao(bb) {
            if (bb === true) {
                aR.bind(ay, a3);
                aR.bind(U, L);
                if (S) {
                    aR.bind(S, K)
                }
            } else {
                aR.unbind(ay, a3, false);
                aR.unbind(U, L, false);
                if (S) {
                    aR.unbind(S, K, false)
                }
            }
            aR.data(B + "_intouch", bb === true)
        }

        function ai(bc, bb) {
            var bd = bb.identifier !== undefined ? bb.identifier : 0;
            aQ[bc].identifier = bd;
            aQ[bc].start.x = aQ[bc].end.x = bb.pageX || bb.clientX;
            aQ[bc].start.y = aQ[bc].end.y = bb.pageY || bb.clientY;
            return aQ[bc]
        }

        function aH(bb) {
            var bd = bb.identifier !== undefined ? bb.identifier : 0;
            var bc = ac(bd);
            bc.end.x = bb.pageX || bb.clientX;
            bc.end.y = bb.pageY || bb.clientY;
            return bc
        }

        function ac(bc) {
            for (var bb = 0; bb < aQ.length; bb++) {
                if (aQ[bb].identifier == bc) {
                    return aQ[bb]
                }
            }
        }

        function aj() {
            var bb = [];
            for (var bc = 0; bc <= 5; bc++) {
                bb.push({start: {x: 0, y: 0}, end: {x: 0, y: 0}, identifier: 0})
            }
            return bb
        }

        function aI(bb, bc) {
            bc = Math.max(bc, aT(bb));
            M[bb].distance = bc
        }

        function aT(bb) {
            if (M[bb]) {
                return M[bb].distance
            }
            return undefined
        }

        function aa() {
            var bb = {};
            bb[p] = aw(p);
            bb[o] = aw(o);
            bb[e] = aw(e);
            bb[x] = aw(x);
            return bb
        }

        function aw(bb) {
            return {direction: bb, distance: 0}
        }

        function aM() {
            return a2 - T
        }

        function au(be, bd) {
            var bc = Math.abs(be.x - bd.x);
            var bb = Math.abs(be.y - bd.y);
            return Math.round(Math.sqrt(bc * bc + bb * bb))
        }

        function a7(bb, bc) {
            var bd = (bc / bb) * 1;
            return bd.toFixed(2)
        }

        function ar() {
            if (G < 1) {
                return z
            } else {
                return c
            }
        }

        function aS(bc, bb) {
            return Math.round(Math.sqrt(Math.pow(bb.x - bc.x, 2) + Math.pow(bb.y - bc.y, 2)))
        }

        function aE(be, bc) {
            var bb = be.x - bc.x;
            var bg = bc.y - be.y;
            var bd = Math.atan2(bg, bb);
            var bf = Math.round(bd * 180 / Math.PI);
            if (bf < 0) {
                bf = 360 - Math.abs(bf)
            }
            return bf
        }

        function aL(bc, bb) {
            var bd = aE(bc, bb);
            if ((bd <= 45) && (bd >= 0)) {
                return p
            } else {
                if ((bd <= 360) && (bd >= 315)) {
                    return p
                } else {
                    if ((bd >= 135) && (bd <= 225)) {
                        return o
                    } else {
                        if ((bd > 45) && (bd < 135)) {
                            return x
                        } else {
                            return e
                        }
                    }
                }
            }
        }

        function at() {
            var bb = new Date();
            return bb.getTime()
        }

        function aY(bb) {
            bb = f(bb);
            var bd = bb.offset();
            var bc = {left: bd.left, right: bd.left + bb.outerWidth(), top: bd.top, bottom: bd.top + bb.outerHeight()};
            return bc
        }

        function E(bb, bc) {
            return (bb.x > bc.left && bb.x < bc.right && bb.y > bc.top && bb.y < bc.bottom)
        }
    }
}));
jQuery('.carousel').swipe({
    swipeLeft: function (event, direction, distance, duration, fingerCount) {
        jQuery(this).carousel('next');
    },
    swipeRight: function (event, direction, distance, duration, fingerCount) {
        jQuery(this).carousel('prev');
    },
    threshold: 0
});

/*
 * Helper
 */
function updateURLParameter(url, param, paramVal) {
    var TheAnchor = null;
    var newAdditionalURL = "";
    var tempArray = url.split("?");
    var baseURL = tempArray[0];
    var additionalURL = tempArray[1];
    var temp = "";

    if (additionalURL) {
        var tmpAnchor = additionalURL.split("#");
        var TheParams = tmpAnchor[0];
        TheAnchor = tmpAnchor[1];
        if (TheAnchor)
            additionalURL = TheParams;

        tempArray = additionalURL.split("&");

        for (i = 0; i < tempArray.length; i++) {
            if (tempArray[i].split('=')[0] != param) {
                newAdditionalURL += temp + tempArray[i];
                temp = "&";
            }
        }
    } else {
        var tmpAnchor = baseURL.split("#");
        var TheParams = tmpAnchor[0];
        TheAnchor = tmpAnchor[1];

        if (TheParams)
            baseURL = TheParams;
    }

    if (TheAnchor)
        paramVal += "#" + TheAnchor;

    var rows_txt = temp + "" + param + "=" + paramVal;
    return baseURL + "?" + newAdditionalURL + rows_txt;
}

/**
 * Scroll and open comments on hash
 */
jQuery(window).ready(function () {
    var hash = location.hash.replace('#', '');
    if (hash == 'comments' && jQuery('body').hasClass('single-product')) {
        var offset = 60;

        jQuery('.nav-tabs a[href="#tab-comments"]').tab('show');

        jQuery('html, body').animate(
            {
                scrollTop: jQuery('#atTab').offset().top - offset
            },
            1000
        );
    }
});


/**
 * User filter
 */
jQuery(document).ready(function () {
    // ordering
    jQuery(".result-filter select#orderby").change(function () {
        if (jQuery('.single-filter').length && jQuery('.single-filter .filterform[data-ajax="true"]').length) {
            // trigger ajax
            var form = jQuery('.single-filter .filterform[data-ajax="true"]');
            form.find('input[name="orderby"]').val(this.value);
            form.submit();
        } else if (jQuery('.widget_filter').length && jQuery('.widget_filter .filterform[data-ajax="true"]').length) {
            // trigger ajax for filter in sidebar @props to manuel
            var form = jQuery('.widget_filter .filterform[data-ajax="true"]');
            form.find('input[name="orderby"]').val(this.value);
            form.submit();
        } else {
            window.location = updateURLParameter(window.location.href, 'orderby', this.value);
        }
    });

    // layout
    jQuery(".result-filter a[href*='layout']").click(function () {
        if (jQuery('.single-filter').length && jQuery('.single-filter .filterform[data-ajax="true"]').length) {
            var form = jQuery('.single-filter .filterform[data-ajax="true"]');
            form.find('input[name="layout"]').val(jQuery(this).attr('data-value'));
            form.submit();

            // active class
            jQuery(".result-filter a[href*='layout']").removeClass('active');
            jQuery(this).addClass('active');

            return false;
        } else if (jQuery('.widget_filter').length && jQuery('.widget_filter .filterform[data-ajax="true"]').length) {
            // trigger ajax for filter in sidebar @props to manuel
            var form = jQuery('.widget_filter .filterform[data-ajax="true"]');
            form.find('input[name="layout"]').val(jQuery(this).attr('data-value'));
            form.submit();

            // active class
            jQuery(".result-filter a[href*='layout']").removeClass('active');
            jQuery(this).addClass('active');

            return false;
        }
    });
});

jQuery(document).ready(function () {
    if (jQuery('.product-select').length) {
        var select2 = jQuery(".product-select select").select2({
            "language": {
                "noResults": function () {
                    return "<?php _e('Keine Treffer', 'affiliatetheme'); ?>";
                }
            },
            matcher: at_compare_search_filter
        });

        select2.on("change", function () {
            select2.find("option:disabled").prop("disabled", false).removeData("data");

            select2.each(function () {
                var val = jQuery(this).val();

                select2.find("option:not(:selected)").filter(function () {
                    return this.value == val;
                }).prop("disabled", true).removeData("data");
            });
        });

        function at_compare_search_filter(params, data) {
            // If there are no search terms, return all of the data
            if (jQuery.trim(params.term) === '') {
                return data;
            }

            // Do not display the item if there is no 'text' property
            if (typeof data.text === 'undefined') {
                return null;
            }

            if (data.text.toLowerCase().indexOf(params.term.toLowerCase()) > -1) {
                return data;
            }

            if (data.text.indexOf(params.term) > -1 || data.element.getAttribute('data-ean').indexOf(params.term) > -1) {
                var matchedData = jQuery.extend({}, data, true);

                return matchedData;
            }

            return false;
        }
    }
});

jQuery(document).ready(function () {
    jQuery('.widget_filter .filterform select[multiple] option').mousedown(function (e) {
        e.preventDefault();
        var originalScrollTop = jQuery(this).parent().scrollTop();
        jQuery(this).prop('selected', jQuery(this).prop('selected') ? false : true);
        var self = this;
        jQuery(this).parent().focus();
        setTimeout(function () {
            jQuery(self).parent().scrollTop(originalScrollTop);
        }, 0);

        return false;
    });
});