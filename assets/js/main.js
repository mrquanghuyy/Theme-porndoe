"use strict";
var ae2EorI = 0,
    ae2Eor = function() {
        var a = Math.round,
            b = Math.floor;

        function c() {
            var a = document.querySelector(".navigation");
            null == a || document.querySelectorAll(".navigation button").forEach(function(b) {
                b.addEventListener("click", function() {
                    a.classList.contains("open") ? (document.body.style.overflow = "auto", document.documentElement.style.overflow = "auto", document.body.style.height = "auto", document.documentElement.style.height = "auto") : (document.body.style.overflow = "hidden", document.documentElement.style.overflow = "hidden"), a.classList.toggle("open")
                })
            })
        }

        // function d() {
        //     var a = window.pageYOffset,
        //         b = document.getElementById("scrollUp"),
        //         c = function b() {
        //             var c = document.querySelector(".header__top");
        //             c.style.top = a > window.pageYOffset && 100 < window.pageYOffset || 100 > window.pageYOffset ? "0" : "-100px", a = window.pageYOffset
        //         };
        //     window.addEventListener("scroll", c), b && b.addEventListener("click", function() {
        //         document.body.scrollTop = 0, document.documentElement.scrollTop = 0
        //     }), "ontouchstart" in document || document.body.classList.add("no-touch")
        // }

        function e() {
            var a, c = document.querySelectorAll(".pagination2874");
            if (0 != c.length) {
                var d = function c(a) {
                    var d = Math.max,
                        f = Math.min,
                        g = Math.ceil,
                        i = function c(b) {
                            b = b.split("&");
                            for (var d = [], e = [], f = 0; f < b.length; f++) d[f] = b[f].split("="), e[f] = d[f][1], d[f] = d[f][0];
                            for (var g, h = location.search.substr(1), i = 0; i < d.length; i++) g = new RegExp("(^|&)" + d[i] + "=[^&]*"), h.match(g) ? h = h.replace(g, "$1" + d[i] + "=" + e[i]) : h += (h ? "&" : "") + d[i] + "=" + e[i];
                            return "?" + h
                        },
                        j = 1 * a.getAttribute("data-page"),
                        k = 1 * a.getAttribute("data-count"),
                        l = 1 * a.getAttribute("data-total"),
                        m = 1 * (a.getAttribute("data-jump") || 6),
                        n = 1 * (a.getAttribute("data-maxpages") || 1005e3),
                        o = a.getAttribute("data-pre-args"),
                        p = a.getAttribute("data-uri") || "";
                    if (k && !(k > l)) {
                        var q = f(g(l / k), n),
                            r = j <= b(m / 2) + 1 ? 0 : 1,
                            t = 1 < j ? j - 1 : 0,
                            u = j < q ? j + 1 : 0,
                            v = j + 2 * m;
                        v > q - m && (v = 0);
                        var w = j - 2 * m;
                        w < m && (w = 0);
                        var x = "<div class=\"pagination\"><div class=\"pagination-holder\"><ul>";
                        t && (x = x + "<li class=\"prev\"><a href=\"" + p + i((o ? o + "&" : "") + "p=" + t) + "\" rel=\"nofollow\"></a></li>"), 420 < screen.width && (r && (x = x + "<li class=\"first\"><a href=\"" + p + i((o ? o + "&" : "") + "p=" + r) + "\" rel=\"nofollow\">first</a></li>"), w && (x = x + "<li class=\"jump\"><a href=\"" + p + i((o ? o + "&" : "") + "p=" + w) + "\" rel=\"nofollow\">...</a></li>"));
                        for (var y = d(1, j - b(m / 2)), s = f(y + m, q), e = y; e <= s; e++) x += "<li class=\"page" + (e == j ? "-current" : "") + "\"><a href=\"" + p + i((o ? o + "&" : "") + "p=" + e) + "\" rel=\"nofollow\">" + e + "</a></li>";
                        420 < screen.width && (v && (x = x + "<li class=\"jump\"><a href=\"" + p + i((o ? o + "&" : "") + "p=" + v) + "\" rel=\"nofollow\">...</a></li>"), q > j + b(m / 2) && (x = x + "<li class=\"last\"><a href=\"" + p + i((o ? o + "&" : "") + "p=" + q) + "\" rel=\"nofollow\">last</a></li>")), u && (x = x + "<li class=\"next\"><a href=\"" + p + i((o ? o + "&" : "") + "p=" + u) + "\" rel=\"nofollow\"></a></li>"), x += "</ul></div></div>", a.innerHTML = x
                    }
                };
                for (a = 0; a < c.length; a++) d(c[a])
            }
        }

        function f() {
            var a = document.querySelectorAll(".sort"),
                b = document.getElementById("search_form");
            document.addEventListener("mouseup", function(c) {
                var d = b && b.contains(c.target);
                !d && searchResponse && searchResponse.classList.remove("search-response--open"), a && a.forEach(function(a) {
                    a.contains(c.target) || a.classList.remove("sort--open")
                })
            }), a.length && a.forEach(function(a) {
                a.addEventListener("click", function(a) {
                    a.stopPropagation(), a.target.classList.contains("input") || this.classList.toggle("sort--open")
                })
            });
            var c = document.querySelectorAll(".modal-container"),
                d = document.querySelectorAll(".modal-button");
            c.length && c.forEach(function(a) {
                a.addEventListener("click", function(a) {
                    var b = document.querySelector(".modal-wrapper"),
                        c = document.querySelector(".modal-close");
                    (!b.contains(a.target) || c.contains(a.target)) && (this.parentElement.classList.remove("open"), document.body.style.overflow = "visible")
                })
            }), d.length && d.forEach(function(a) {
                a.addEventListener("click", function() {
                    this.parentElement.classList.add("open"), document.body.style.overflow = "hidden"
                })
            })
        }

        function g() {
            function c(d) {
                k("/controller/", "act=vote&section=video&vote=" + d + "&object_id=" + vpage_data.vid, "POST", function(f) {
                    var e = JSON.parse(f.currentTarget.responseText),
                        g = document.getElementsByClassName("voters")[0],
                        h = document.getElementsByClassName("scale-holder")[0];
                    if (null != e.error) return void l({
                        type: "error",
                        text: g.getAttribute("data-error")
                    });
                    l({
                        type: "success",
                        text: g.getAttribute("data-success")
                    });
                    var b = null;
                    0 < d ? (vpage_data.likes++, b = vpage_data.likes, g = document.getElementsByClassName("rate-like")[0]) : (vpage_data.dislikes++, b = vpage_data.dislikes, g = document.getElementsByClassName("rate-dislike")[0]), g && (g.nextSibling.data = b)
                })
            }
            if ("undefined" != typeof vpage_data) {
                var d, e;
                return null != (d = document.querySelector(".rate-like")) && null != (e = document.querySelector(".rate-dislike")) && void(d.addEventListener("click", function() {
                    c(1)
                }), e.addEventListener("click", function() {
                    c(0)
                }))
            }
        }

        function h() {
            var b;
            if (!(null == (b = document.getElementById("DnwWE")) || 10 > b.childElementCount)) {
                var c = function f(c, e) {
                        if (null != c && null != c[0]) {
                            if (!c[0].isIntersecting) return;
                            d.unobserve(c[0].target)
                        }
                        var g = document.getElementById("DnwWE_tpl").value;
                        fetch("/related/" + vpage_data.vid + "/" + b.childElementCount + ".1").then(function(a) {
                            return a.json()
                        }).then(function(c) {
                            var d, e, f, j, k = "";
                            if (null == c.error) {
                                for (f = 0; f < c.videos.length; f++) j = g, d = a(100 * (c.videos[f].rating / 5)), e = 50 <= d || 0 === d ? "positive" : "negative", 75 <= d && (e += " rating--accent"), j = j.replace(/%video_id%/g, c.videos[f].video_id).replace(/%tid%/g, c.videos[f].dir).replace(/%dir%/g, c.videos[f].dir).replace(/%rating%/g, d + "%").replace(/%pos_or_neg%/g, e).replace(/%title%/g, c.videos[f].title).replace(/%scr%/g, c.videos[f].scr).replace(/%duration%/g, c.videos[f].duration).replace(/%title_truncated%/g, c.videos[f].title).replace(/%content_source_name%/g, c.videos[f].content_source_name ? c.videos[f].content_source_name + ": " : "").replace(/%source_dir%/g, c.videos[f].source_dir ? c.videos[f].source_dir : "").replace(/%viewed%/g, c.videos[f].video_viewed).replace(/%pv%/g, "//" + EoCR4A[c.videos[f].sg_id] + "/preview/" + c.videos[f].video_id + ".mp4"), k += j;
                                b.innerHTML = k, runLazyLoad(), LixERi()
                            }
                        })
                    },
                    d = new IntersectionObserver(c, {
                        threshold: .001
                    });
                d.observe(b)
            }
        }
        if ("loading" != document.readyState) {
            if (clearInterval(ae2EorI), null == window.ae2EorA) window.ae2EorA = 1;
            else return;
            window.device = {
                isIOS: ["iPad Simulator", "iPhone Simulator", "iPod Simulator", "iPad", "iPhone", "iPod"].includes(navigator.platform) || navigator.userAgent.includes("Mac") && "ontouchend" in document,
                isAndroid: -1 < navigator.userAgent.toLowerCase().indexOf("android"),
                isChrome: /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor)
            };
            var i = function b(a) {
                    var c = !!(1 < arguments.length && void 0 !== arguments[1]) && arguments[1];
                    return (c ? a.toLowerCase() : a).replace(/(?:^|\s)+\S/g, function(a) {
                        return a.toUpperCase()
                    })
                },
                j = function b(a) {
                    return encodeURIComponent(a).replaceAll("%20", "+").replaceAll("!", "%21").replaceAll("'", "%27").replaceAll("(", "%28").replaceAll(")", "%29").replaceAll("*", "%2A")
                },
                k = function e(a, b, c, d) {
                    var f = new XMLHttpRequest;
                    f.open(c, a, !0), "post" == c.toLowerCase() && f.setRequestHeader("Content-type", "application/x-www-form-urlencoded"), null != d && f.addEventListener("load", d), f.send(b)
                },
                l = function b(a) {
                    var c = document.createElement("div"),
                        d = document.createElement("i");
                    switch (c.className = "notify", c.appendChild(d), setTimeout(function() {
                            c.classList.add("is-active")
                        }, 200), a.type) {
                        case "error":
                            d.className = "i i-close";
                            break;
                        default:
                            d.className = "i i-check"
                    }
                    c.insertAdjacentHTML("beforeend", a.text), document.body.appendChild(c), setTimeout(function() {
                        c.classList.remove("is-active")
                    }, 3e3), setTimeout(function() {
                        c.remove()
                    }, 3300)
                },
                m = !1;
            try {
                var n = Object.defineProperty({}, "passive", {
                    get: function a() {
                        m = !0
                    }
                });
                window.addEventListener("test", null, n), window.removeEventListener("test", null, n)
            } catch (a) {
                console.err("passiveSupported test fail")
            }
            window.runLazyLoad = function() {
                var a, b, c = function c(a, b) {
                        var d, e;
                        for (d = 0; d < a.length; d++) a[d].isIntersecting && (f.unobserve(a[d].target), null != (e = a[d].target.getAttribute("data-original")) && "" != e && (a[d].target.removeAttribute("data-original"), a[d].target.src = e))
                    },
                    d = document.getElementsByTagName("IMG"),
                    e = {
                        threshold: .001
                    },
                    f = new IntersectionObserver(c, e);
                for (a = 0; a < d.length; a++) null != (b = d[a].getAttribute("data-original")) && "" != b && f.observe(d[a])
            }, setTimeout(runLazyLoad, 100), window.runPreviews = function() {
                function b(a) {
                    return null !== navigator.userAgent.toLowerCase().match(a)
                }
                if (!window.VutRi78d) {
                    window.VutRi78d = !0;
                    var c = function a() {
                        var b = !1;
                        return function(c) {
                            (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(c) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(c.substr(0, 4))) && (b = !0)
                        }(navigator.userAgent || navigator.vendor || window.opera), b
                    };
                    c = c(), c = c ? c : "MacIntel" === navigator.platform && 1 < navigator.maxTouchPoints;
                    var d = b(/safari/i) && !b(/chrome/i) && !b(/crios/i) && !b(/chromium/i) && !b(/android/i),
                        e = b(/ucbrowser/i);
                    if (e) return 0;
                    var f = document.createElement("style");
                    f.innerHTML = "@keyframes OmE32w{from{width:0%}to{width:100%}}.t5Fid0{position:absolute;top:0;left:0;overflow:hidden;}.t5FiV{position:absolute;top:-999px;bottom:-999px;left:-999px;right:-999px;margin:auto;min-width:100%;min-height:100%}.t5Fipgb{position:absolute;top:0;background-color:#ffa31a;height:2px;animation-name:OmE32w;z-index:99;width:0}.LkHid{visibility:hidden}.t5FiDeb{pointer-events:all;position:fixed;z-index:9999;top:0;left:0;opacity:0.66;background:#000;color:#eee;width:75%;height:30%;overflow:auto}.t5FiDeb pre{margin:0}.LkNon{display:none !important}", document.getElementsByTagName("head")[0].appendChild(f);
                    var g = !1,
                        h = function b(a) {},
                        j = function c(b) {
                            var d = b.currentTarget;
                            if (d.href == g.href) return void(null != l && (clearTimeout(l), l = null));
                            k();
                            var e;
                            g = d;
                            var f = d.getElementsByTagName("IMG")[0],
                                h = f.parentNode,
                                i = h.getElementsByClassName("t5Fid0");
                            if (i && (i = i[0]), !i) {
                                f.setAttribute("alt", ""), d.setAttribute("title", ""), i = document.createElement("div"), i.className = "t5Fid0", i.style.width = "100%", i.style.height = "100%", e = document.createElement("video"), e.loop = !0, e.className = "t5FiV", e.preload = "none", e.muted = !0, e.src = f.getAttribute("data-preview"), f.removeAttribute("data-preview"), e.setAttribute("playsinline", ""), e.setAttribute("webkit-playsinline", ""), e.setAttribute("disableremoteplayback", ""), e.setAttribute("disablepictureinpicture", ""), e.onloadeddata = function() {
                                    f.classList.add("LkNon")
                                }, e.onloadedmetadata = function() {
                                    e.play(!0);
                                    var b = a(100 * e.videoWidth / e.videoHeight) / 100,
                                        c = a(100 * f.parentElement.offsetWidth / f.parentElement.offsetHeight) / 100;
                                    b <= c && .7 < b ? (e.style.width = "100%", e.style.height = "auto") : (e.style.width = "auto", e.style.height = "100%")
                                }, e.load(), h.insertBefore(i, f), i.appendChild(e);
                                var j = document.createElement("div");
                                j.className = "t5Fipgb", j.style.animationDuration = a(10 + 5 * Math.random()) / 20 + "s", i.insertBefore(j, e)
                            } else {
                                if (i.classList.remove("LkNon"), e = i.getElementsByTagName("VIDEO"), e && (e = e[0]), !e) return;
                                e.src = e.getAttribute("data-preview"), e.load(), i.firstElementChild.classList.remove("LkNon")
                            }
                        },
                        k = function b(a) {
                            var c;
                            if (a ? (c = a.currentTarget, g = !1) : c = g, "undefined" == typeof c || !c) return 0;
                            var d = c.getElementsByTagName("img");
                            d = d[d.length - 1];
                            var e = d.parentNode,
                                f = e.getElementsByClassName("t5Fid0");
                            if (f && (f = f[0]), !!f) {
                                f.classList.add("LkNon");
                                var h = f.getElementsByTagName("VIDEO");
                                h && (h = h[0]), h && (h.setAttribute("data-preview", h.src), h.removeAttribute("src"), h.load(), d.classList.remove("LkNon"))
                            }
                        };
                    window.LixERi = function() {
                        for (var a = document.getElementsByTagName("IMG"), b = 0; b < a.length; b++)
                            if (null != a[b].getAttribute("data-preview")) {
                                var d = a[b].parentElement;
                                "A" != d.tagName && (d = d.parentElement, "A" != d.tagName && (d = d.parentElement)), c ? d.addEventListener("touchmove", j, !!m && {
                                    passive: !0
                                }) : (d.addEventListener("mouseenter", j), d.addEventListener("mouseleave", k))
                            }
                    };
                    var l = null;
                    document.body.addEventListener("touchstart", function(a) {
                        g && (null != l && (clearTimeout(l), l = null), l = setTimeout(function() {
                            k(), g = !1
                        }, 100))
                    }), LixERi()
                }
            }, setTimeout(runPreviews, 10), window.initSearch = function() {
                var a,
                    c = document.getElementById("search");
                window.searchResponse = document.getElementById("searchResponse");
                var d = document.getElementById("search_form"),
                    ajax = "undefined" != typeof ajaxUrl ? ajaxUrl : "",
                    nonce = "undefined" != typeof twfSearchNonce ? twfSearchNonce : "";
                d && d.addEventListener("submit", function(a) {
                    if (a.currentTarget && a.currentTarget.q) {
                        var b = a.currentTarget.q.value;
                        null != b && 2 < b.length ? (b = i(b, !0), b = j(b), a.currentTarget.action = a.currentTarget.action.split("?")[0] + "?q=" + b) : (a.stopPropagation(), a.preventDefault())
                    }
                });
                var f = function(a) {
                    searchResponse.contains(a.target) || c.contains(a.target) || (searchResponse.classList.remove("search-response--open"), window.removeEventListener("click", f))
                };
                c && c.addEventListener("click", function(a) {
                    window.removeEventListener("click", f), 2 < c.value.length && (searchResponse.classList.add("search-response--open"), window.addEventListener("click", f))
                }), c && c.addEventListener("input", function() {
                    clearTimeout(a), window.removeEventListener("click", f), a = setTimeout(function() {
                        var a = c.value;
                        if (2 < a.length && ajax && nonce) {
                            window.addEventListener("click", f);
                            var g = function(a) {
                                if (searchResponse.innerHTML = "", searchResponse.classList.remove("search-response--open"), !a.success || !a.data) return;
                                var b = a.data,
                                    e = function(a, b) {
                                        if (a && a.length) {
                                            var c = document.createElement("div");
                                            if (b) {
                                                var d = document.createElement("p");
                                                d.innerText = b, c.appendChild(d)
                                            }
                                            a.forEach(function(a) {
                                                var b = document.createElement("a");
                                                b.href = a.url || "#", b.innerText = a.label || "", c.appendChild(b)
                                            }), searchResponse.appendChild(c)
                                        }
                                    };
                                e(b.suggestions, null), e(b.channels, "channels"), e(b.pornstars, "pornstars"), (b.suggestions && b.suggestions.length || b.channels && b.channels.length || b.pornstars && b.pornstars.length) && searchResponse.classList.add("search-response--open")
                            };
                            "function" == typeof jQuery ? jQuery.ajax({
                                url: ajax,
                                type: "POST",
                                data: {
                                    action: "search_suggestions",
                                    nonce: nonce,
                                    term: a
                                },
                                dataType: "json"
                            }).done(function(a) {
                                g(a)
                            }).fail(function() {}) : "function" == typeof window.fetch ? window.fetch(ajax, {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
                                },
                                body: "action=search_suggestions&nonce=" + encodeURIComponent(nonce) + "&term=" + encodeURIComponent(a),
                                credentials: "same-origin"
                            }).then(function(a) {
                                return a.json()
                            }).then(function(a) {
                                g(a)
                            }).catch(function() {}) : searchResponse.classList.remove("search-response--open")
                        } else searchResponse.classList.remove("search-response--open")
                    }, 300)
                })
            }, setTimeout(initSearch, 10), setTimeout(c, 10), setTimeout(e, 12), setTimeout(f, 13), setTimeout(g, 23), setTimeout(h, 3e3)
        }
    };
ae2EorI = setInterval(ae2Eor, 100);