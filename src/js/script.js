jQuery(function ($) {
  // この中であればWordpressでも「$」が使用可能になる

  // ハンバーガーメニュー
  $(".header__hamburger").on("click", function () {
    $(this).toggleClass("is-active");
    $(".js-sp-nav").toggleClass("is-active");

    // bodyタグに「is-locked」クラスを追加/削除してスクロールを無効化
    if ($(".js-sp-nav").hasClass("is-active")) {
      $("body").addClass("is-locked");
    } else {
      $("body").removeClass("is-locked");
    }
    return false;
  });

  // ハンバーガーメニューとヘッダーの要素を取得
  const hamburger = document.getElementById("hamburger");
  const header = document.querySelector(".header");

  // ハンバーガーメニューがクリックされたときの処理
  hamburger.addEventListener("click", function () {
    header.classList.toggle("is-active");
  });

  // トップページfvのSwiper
  var swiper = new Swiper(".js-fv-Swiper", {
    autoplay: {
      delay: 2000,
      disableOnInteraction: false,
    },
    loop: true,
    effect: "fade",
    fadeEffect: {
      crossFade: true,
    },
    speed: 3000,
  });

  //トップページcampaignセクションのSwiper
  var swiper = new Swiper(".js-campaign-Swiper", {
    loop: true,
    speed: 2000,
    slidesPerView: "auto",
    autoplay: {
      delay: 4000,
      disableOnInteraction: false,
      waitForTransition: false,
    },
    navigation: {
      nextEl: ".swiper-button-next", // 右ボタン
      prevEl: ".swiper-button-prev", // 左ボタン
    },
  });

  //写真の前に青の要素が出てくる実装
  $(document).ready(function () {
    // 要素の取得とスピードの設定
    let box = $(".js-colorbox"),
      speed = 700;
    // .colorboxの付いた全ての要素に対して下記の処理を行う
    box.each(function () {
      $(this).append('<div class="is-color"></div>');
      var color = $(this).find($(".is-color")),
        image = $(this).find("img");
      var counter = 0;
      image.css("opacity", "0");
      color.css("width", "0%");
      // スクロールイベントで背景色が画面に現れたかどうかチェック
      $(window).on("scroll", function () {
        var windowBottom = $(window).scrollTop() + $(window).height();
        var colorTop = color.offset().top;
        if (windowBottom > colorTop && counter == 0) {
          color.delay(200).animate({ width: "100%" }, speed, function () {
            image.css("opacity", "1");
            $(this).css({ left: "0", right: "auto" });
            $(this).animate({ width: "0%" }, speed);
          });
          counter = 1;
        }
      });
    });
  });

  //button-top
  var pagetop = $("#js-button-top");
  pagetop.hide();
  $(window).scroll(function () {
    if ($(this).scrollTop() > 80) {
      pagetop.fadeIn();
    } else {
      pagetop.fadeOut();
    }
  });

//blogページのアーカイブトグル
document.querySelectorAll(".js-archive__toggle").forEach((item) => {
  item.classList.add("open"); // 初期状態でトグルを開いた状態にする

  item.addEventListener("click", function (event) {
    event.preventDefault();
    // クラス 'open' をトグル（矢印の向き）
    item.classList.toggle("open");

    // 月別アイテムのトグル処理
    let currentItem = item.nextElementSibling;
    while (
      currentItem &&
      currentItem.classList.contains("aside__archive-item--month")
    ) {
      currentItem.classList.toggle("show");
      currentItem = currentItem.nextElementSibling;
    }
  });

  // 月別項目を初期状態で全て表示
  let currentItem = item.nextElementSibling;
  while (
    currentItem &&
    currentItem.classList.contains("aside__archive-item--month")
  ) {
    currentItem.classList.add("show");
    currentItem = currentItem.nextElementSibling;
  }
});



  //faqのアコーディオン
  $(".js-faq").on("click", function () {
    $(this).toggleClass("close");
    $(this).next(".faq__answer").slideToggle();
  });

  // Aboutページ モーダル関連の要素を取得
  const modal = document.getElementById("js-modal");
  const modalImg = document.getElementById("js-modal-img");
  const modalOpenElements = document.querySelectorAll(".gallery__photo");
  const modalClose = document.getElementById("js-modal__close");

  // モーダルが開いている時の後ろ スクロールを制御する関数
  function toggleBodyLock(isLocked) {
    if (isLocked) {
      document.body.style.overflow = "hidden"; // スクロールを無効にする
    } else {
      document.body.style.overflow = ""; // スクロールを再度有効にする
    }
  }

  // 各画像クリックでモーダルを表示
  modalOpenElements.forEach((item) => {
    item.addEventListener("click", function () {
      const imgSrc = item.querySelector("img").src; // クリックされた画像のソースを取得
      modalImg.src = imgSrc; // モーダル内の画像に設定
      modal.style.display = "flex"; // モーダルを表示
      toggleBodyLock(true); // スクロールを無効化
    });
  });

  // モーダル外をクリックした場合にモーダルを閉じる
  modal.addEventListener("click", function (event) {
    if (event.target === modal || event.target === modalImg) {
      modal.style.display = "none"; // モーダルを閉じる
      toggleBodyLock(false); // スクロールを再度有効化
    }
  });
});

//informationページのタブ切り替え

document.addEventListener("DOMContentLoaded", function () {
  const tabs = document.querySelectorAll(".tab__name");
  const contents = document.querySelectorAll(".tab__content");

  const HEADER_HEIGHT = 90; // ヘッダーの高さを設定

  // タブをアクティブにする関数
  function activateTab(index) {
    document
      .querySelector(".tab__name.is-change")
      .classList.remove("is-change");
    document.querySelector(".tab__content.is-show").classList.remove("is-show");

    tabs[index].classList.add("is-change");
    contents[index].classList.add("is-show");
  }

  // スクロール位置を調整する関数
  function scrollToTab(index) {
    const tabPosition =
      tabs[index].getBoundingClientRect().top +
      window.pageYOffset -
      HEADER_HEIGHT;
    window.scrollTo({
      top: tabPosition,
      behavior: "smooth",
    });
  }

  // 各タブにクリックイベントを追加
  tabs.forEach((tab, index) => {
    tab.addEventListener("click", function (event) {
      event.preventDefault();
      activateTab(index);
    });
  });

  // ページ読み込み後にハッシュを確認してタブにスクロール
  function checkHash() {
    const hash = window.location.hash;
    if (hash === "#tab3") {
      activateTab(2);
      setTimeout(() => scrollToTab(2), 1); // 遅延でスクロール実行 ここがチカっとする原因 これを消すとスクロールされない
    } else if (hash === "#tab1") {
      activateTab(0);
      setTimeout(() => scrollToTab(0), 1);
    } else if (hash === "#tab2") {
      activateTab(1);
      setTimeout(() => scrollToTab(1), 1);
    }
  }

  // ページ初期読み込み時とハッシュ変更時にハッシュを確認
  setTimeout(checkHash, 1); // ページ読み込み後も遅延でチェック
  window.addEventListener("hashchange", checkHash);
});
