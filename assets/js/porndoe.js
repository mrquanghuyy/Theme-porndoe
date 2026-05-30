document.addEventListener('DOMContentLoaded', function () {
    var panels = document.querySelectorAll('[data-pd-panel]');
    var headerHolder = document.querySelector('[data-pd-header]');
    var lastY = window.scrollY;

    function closePanels(exceptName) {
        panels.forEach(function (panel) {
            if (exceptName && panel.getAttribute('data-pd-panel') === exceptName) {
                return;
            }
            panel.hidden = true;
        });
    }

    document.querySelectorAll('[data-pd-toggle]').forEach(function (toggle) {
        toggle.addEventListener('click', function (event) {
            event.preventDefault();
            var name = toggle.getAttribute('data-pd-toggle');
            var panel = document.querySelector('[data-pd-panel="' + name + '"]');
            if (!panel) {
                return;
            }

            var willOpen = panel.hidden;
            closePanels(name);
            panel.hidden = !willOpen;
        });
    });

    document.querySelectorAll('[data-pd-close]').forEach(function (button) {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            var name = button.getAttribute('data-pd-close');
            var panel = document.querySelector('[data-pd-panel="' + name + '"]');
            if (!panel) {
                return;
            }

            panel.hidden = true;
        });
    });

    document.addEventListener('click', function (event) {
        var target = event.target;
        if (target.closest('[data-pd-toggle]') || target.closest('[data-pd-panel]')) {
            return;
        }
        closePanels();
    });

    document.querySelectorAll('[data-pd-pills]').forEach(function (carousel) {
        var scrollable = carousel.querySelector('.-pc-scrollable');
        if (!scrollable) {
            return;
        }

        carousel.querySelectorAll('[data-pd-pill-nav]').forEach(function (button) {
            button.addEventListener('click', function () {
                var direction = parseInt(button.getAttribute('data-pd-pill-nav'), 10) || 1;
                scrollable.scrollBy({
                    left: direction * 280,
                    behavior: 'smooth'
                });
            });
        });
    });

    document.querySelectorAll('[data-pd-accordion]').forEach(function (button) {
        button.addEventListener('click', function () {
            var panel = button.parentElement.querySelector('[data-pd-accordion-panel]');
            if (!panel) {
                return;
            }

            var expanded = button.getAttribute('aria-expanded') === 'true';
            button.setAttribute('aria-expanded', expanded ? 'false' : 'true');
            var icon = button.querySelector('.-footer-group-more');
            if (icon) {
                icon.setAttribute('data-active', expanded ? 'false' : 'true');
            }
            panel.setAttribute('data-active', expanded ? 'false' : 'true');
        });
    });

    document.querySelectorAll('[data-pd-toggle-more]').forEach(function (button) {
        button.addEventListener('click', function () {
            var targetId = button.getAttribute('data-pd-toggle-more');
            var section = document.getElementById(targetId);
            if (!section) {
                return;
            }

            var expanded = section.getAttribute('data-active') === 'true';
            section.setAttribute('data-active', expanded ? 'false' : 'true');
            button.textContent = expanded ? 'Show more' : 'Show Less';
        });
    });

    document.querySelectorAll('[data-pd-nav-trigger]').forEach(function (button) {
        button.addEventListener('click', function () {
            var targetName = button.getAttribute('data-pd-nav-trigger');
            var target = document.querySelector('[data-pd-nav-target="' + targetName + '"]');
            var arrow = button.querySelector('.-arrow');
            if (!target) {
                return;
            }

            var isOpen = target.getAttribute('data-active') === 'true';
            target.setAttribute('data-active', isOpen ? 'false' : 'true');
            if (arrow) {
                arrow.setAttribute('data-active', isOpen ? 'false' : 'true');
            }
        });
    });

    document.querySelectorAll('.mobile-search-form').forEach(function (form) {
        var input = form.querySelector('.mobile-search-input');
        var reset = form.querySelector('.mobile-search-reset');
        var submit = form.querySelector('.mobile-search-submit');
        if (!input || !reset || !submit) {
            return;
        }

        function syncSearchState() {
            var hasValue = input.value.trim() !== '';
            reset.style.display = hasValue ? '' : 'none';
            submit.disabled = !hasValue;
        }

        input.addEventListener('input', syncSearchState);
        form.addEventListener('reset', function () {
            window.setTimeout(syncSearchState, 0);
        });

        syncSearchState();
    });

    (function initSingleVote() {
        var likeButton = document.querySelector('.btn-like');
        var dislikeButton = document.querySelector('.btn-dislike');
        if (!likeButton || !dislikeButton || typeof window.jQuery === 'undefined' || typeof ajaxUrl === 'undefined') {
            return;
        }

        var $ = window.jQuery;
        var isSubmitting = false;

        function setVoteIcon(button, isActive) {
            if (!button) {
                return;
            }

            var outline = button.querySelector('[data-pd-vote-outline]');
            var check = button.querySelector('[data-pd-vote-check]');
            if (outline) {
                outline.style.display = isActive ? 'none' : '';
            }
            if (check) {
                check.style.display = isActive ? '' : 'none';
            }
            button.setAttribute('aria-pressed', isActive ? 'true' : 'false');
        }

        function updateLikeStats(count) {
            document.querySelectorAll('[data-pd-like-count]').forEach(function (node) {
                node.textContent = String(count);
            });
        }

        function submitVote(button, ratingValue) {
            if (isSubmitting) {
                return;
            }

            var postId = button.getAttribute('data-id');
            if (!postId) {
                return;
            }

            isSubmitting = true;

            $.post(ajaxUrl, {
                action: 'ratemovie',
                rating: ratingValue,
                postid: postId
            }, function (resp) {
                if (!resp || resp.status !== 'success') {
                    isSubmitting = false;
                    return;
                }

                updateLikeStats(resp.like_count);
                setVoteIcon(likeButton, ratingValue === 1);
                setVoteIcon(dislikeButton, ratingValue === 0);
                isSubmitting = false;
            }, 'json').fail(function () {
                isSubmitting = false;
            });
        }

        likeButton.addEventListener('click', function (event) {
            event.preventDefault();
            submitVote(likeButton, 1);
        });

        dislikeButton.addEventListener('click', function (event) {
            event.preventDefault();
            submitVote(dislikeButton, 0);
        });
    }());

    window.addEventListener('scroll', function () {
        if (!headerHolder) {
            return;
        }

        var currentY = window.scrollY;
        headerHolder.setAttribute('data-scroll', currentY <= 10 || currentY < lastY ? 'up' : 'down');
        lastY = currentY;
    }, { passive: true });
});
