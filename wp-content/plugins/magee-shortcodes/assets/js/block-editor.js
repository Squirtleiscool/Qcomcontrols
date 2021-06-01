!function c(i, l, u) {
    function a(t, e) {
        if (!l[t]) {
            if (!i[t]) {
                var r = "function" == typeof require && require;
                if (!e && r) return r(t, !0);
                if (s) return s(t, !0);
                var n = new Error("Cannot find module '" + t + "'");
                throw n.code = "MODULE_NOT_FOUND",
                n
            }
            var o = l[t] = {
                exports: {}
            };
            i[t][0].call(o.exports,
            function(e) {
                return a(i[t][1][e] || e)
            },
            o, o.exports, c, i, l, u)
        }
        return l[t].exports
    }
    for (var s = "function" == typeof require && require,
    e = 0; e < u.length; e++) a(u[e]);
    return a
} ({
    1 : [function(e, t, r) {
        "use strict";
        var n = wp.element.Fragment,
        o = wp.editor.BlockControls,
        c = wp.components,
        i = c.SVG,
        l = c.Path;
        wp.hooks.addFilter("editor.BlockEdit", "magee-shortcodes/with-insert-shortcode-button",
        function(t) {
            return function(e) {
                return -1 === MSBlockSettings.supportedBlocks.indexOf(e.name) ? React.createElement(t, e) : React.createElement(n, null, React.createElement(t, e), React.createElement(o, {
                    controls: [{
                        icon: React.createElement(i, {
                            viewBox: "0 0 20 20",
                            xmlns: "http://www.w3.org/2000/svg"
                        },
                        React.createElement(l, {
                            d: "M6 14H4V6h2V4H2v12h4z M7.1 17h2.1l3.7-14h-2.1z M14 4v2h2v8h-2v2h4V4z"
                        })),
                        title: MSBlockEditorL10n.insertShortcode,
                        onClick: function() {
                            window.MSG.Api({props:e})
                            var popup = 'shortcode-generator';
                            if (typeof params != 'undefined' && params.identifier) {
                                popup = params.identifier
                            }
                            var magee = MSBlockEditorL10n.insertShortcode + "<span class='shortcode_show_name'></span><a class='link-doc' target='_blank' href='"+MSBlockSettings.docUrl+"'>" + MSBlockEditorL10n.doc + "</a><a class='link-forum' target='_blank' href='"+MSBlockSettings.forumUrl+"'>" + MSBlockEditorL10n.forums + "</a>";
                            var height = jQuery(window).height() - 150;
                            tb_show(magee, ajaxurl + "?action=magee_shortcodes_popup&popup=" + popup + "&target=&width=800&height=" + height)
                        }
                    }]
                }))
            }
        })
    },
    {}]
},
{},
[1]);