"use strict"; var Gauge = function (t, s) { t && t instanceof jQuery && this.init(t, s) }; Gauge.defaults = { template: ['<div class="b-gauge">', '<svg class="b-gauge__paths b-gauge__block" version="1.1" xmlns="http://www.w3.org/2000/svg"></svg>', '<div class="b-gauge__marks b-gauge__block"></div>', '<div class="b-gauge__labels b-gauge__block"></div>', "</div>"].join(""), values: { 0: "0", 10: "1", 20: "2", 30: "3", 40: "4", 50: "5", 60: "6", 70: "7", 80: "8", 90: "9", 100: "10" }, colors: { 0: "#666", 50: "#ffa500", 90: "#f00" }, angles: [150, 390], lineWidth: 4, arrowWidth: 10, arrowColor: "#1e98e4", inset: !1, value: 0 }, Gauge.prototype = { constructor: Gauge, gaps: [[20, 12], [20, 8]], init: function (t, s) { var i = this; this.options = $.extend({}, Gauge.defaults, s), this.$element = $(t), this.draw(), $(window).on("resize", function () { i.draw() }) }, draw: function () { this.$element.html(this.options.template), this.$paths = this.$element.find(".b-gauge__paths"), this.$labels = this.$element.find(".b-gauge__labels"), this.$marks = this.$element.find(".b-gauge__marks"), this.getSizes(), this.setGaps(), this.createPaths(), this.createArrow(), this.createValues(), this.createMarks(), this.setValue(this.options.value) }, getSizes: function () { var t = this.options.inset === !1; this.options.pathsWidth = t ? this.$paths.innerWidth() - 2 * this.gaps[0][0] : this.$paths.innerWidth(), this.options.pathsHeight = t ? this.$paths.innerHeight() - 2 * this.gaps[0][0] : this.$paths.innerHeight(), this.options.labelsWidth = t ? this.$labels.innerWidth() : this.$labels.innerWidth() - 2 * this.gaps[0][0], this.options.labelsHeight = t ? this.$labels.innerHeight() : this.$labels.innerHeight() - 2 * this.gaps[0][0], this.options.marksWidth = t ? this.$marks.innerWidth() - 2 * this.gaps[0][1] : this.$marks.innerWidth() - 2 * this.gaps[1][1], this.options.marksHeight = t ? this.$marks.innerHeight() - 2 * this.gaps[0][1] : this.$marks.innerWidth() - 2 * this.gaps[1][1] }, setGaps: function () { var t = this.options.inset === !1; this.$paths.css({ left: t ? this.gaps[0][0] : 0, top: t ? this.gaps[0][0] : 0 }), this.$labels.css({ left: t ? 0 : this.gaps[0][0], top: t ? 0 : this.gaps[0][0] }), this.$marks.css({ left: t ? this.gaps[0][1] : this.gaps[1][1], top: t ? this.gaps[0][1] : this.gaps[1][1] }) }, walkPercents: function (t, s) { var i, e = this, a = function (t, s) { return t - s }, h = Object.keys(t).map(parseFloat).sort(a); $.each(h, function (t, a) { i = e.getPercentAngle(a), s.call(e, a, i) }) }, getPercentAngle: function (t) { return .01 * t * (this.options.angles[1] - this.options.angles[0]) + this.options.angles[0] }, getCoordinate: function (t, s, i) { return t = t * Math.PI / 180, [Math.cos(t) * s / 2 + s / 2, Math.sin(t) * i / 2 + i / 2] }, createPaths: function () { var t, s = this, i = this.options.angles[0]; this.$paths.html(""), this.walkPercents(this.options.colors, function (e, a) { t && s.createPath(i, a, t), t = this.options.colors[e], i = a }); var e = this.options.angles[1]; s.createPath(i, e, t) }, createPath: function (t, s, i) { var e = this.getCoordinate(t, this.options.pathsWidth, this.options.pathsHeight), a = this.getCoordinate(s, this.options.pathsWidth, this.options.pathsHeight), h = "M " + e + " A " + this.options.pathsWidth / 2 + " " + this.options.pathsHeight / 2 + " 0 " + (Math.abs(s - t) > 180 ? 1 : 0) + " 1 " + a; this.appendSVG("path", { class: "b-gauge__path", d: h, stroke: i, "stroke-width": this.options.lineWidth, fill: "none" }) }, createArrow: function () { this.appendSVG("circle", { class: "b-gauge__center", cx: this.options.pathsWidth / 2, cy: this.options.pathsHeight / 2, r: this.options.arrowWidth, fill: this.options.arrowColor }); var t = [this.options.pathsWidth / 2 - this.options.arrowWidth / 2 + "," + this.options.pathsHeight / 2, this.options.pathsWidth / 2 + this.options.arrowWidth / 2 + "," + this.options.pathsHeight / 2, this.options.pathsWidth / 2 + ",0"].join(" "); this.appendSVG("polyline", { class: "b-gauge__arrow", points: t, fill: this.options.arrowColor, height: this.options.pathsHeight / 2 }) }, appendSVG: function (t, s) { var i = document.createElementNS("http://www.w3.org/2000/svg", t); $.each(s, function (t, s) { i.setAttribute(t, s) }), this.$paths.append(i) }, setValue: function (t) { this.options.value = t; var s = this.getPercentAngle(t), i = this.$element.find(".b-gauge__arrow"), e = i[0].getAttribute("height"); i.attr({ transform: "rotate(" + (s + 90) + " " + e + " " + e + ")" }) }, createValues: function () { this.walkPercents(this.options.values, function (t, s) { var i = this.getCoordinate(s, this.options.labelsWidth, this.options.labelsHeight), e = $("<div>").addClass("b-gauge__label").text(this.options.values[t]); this.$labels.append(e), e.css({ left: i[0] - e.width() / 2, top: i[1] - e.height() / 2 }) }) }, createMarks: function () { this.walkPercents(this.options.values, function (t, s) { var i = this.getCoordinate(s, this.options.marksWidth, this.options.marksHeight), e = $("<div>").addClass("b-gauge__mark"); this.$marks.append(e), e.css({ transform: "rotate(" + (s + 90) + "deg)", left: i[0] - e.width() / 2, top: i[1] - e.height() / 2 }) }) } }, $.fn.gauge = function (t) { return this.each(function () { var s = $(this), i = s.data("plugin-gauge"), e = "object" == typeof t && t; i || s.data("plugin-gauge", i = new Gauge($(this), e)), "string" == typeof t && i[t]() }) }, $.fn.gauge.Constructor = Gauge;