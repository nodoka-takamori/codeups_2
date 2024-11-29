
<?php get_header(); ?>
<main>
      <section class="contact__mv mv">
        <div class="mv__title-wrap">
          <p class="mv__title">Contact</p>
        </div>
        <picture class="mv__photo">
          <source
            srcset="<?php echo get_template_directory_uri(); ?>/dist/assets/images/common/contact_mv-sp.jpg"
            media="(max-width:768px)"
          />
          <img
            src="<?php echo get_template_directory_uri(); ?>/dist/assets/images/common/contact_mv.jpg"
            alt="2匹の黄色の熱帯魚が海で泳いでいる"
          />
        </picture>
      </section>
      <?php get_template_part('breadcrumb'); ?>
      <div class="page-thanks">
        <div class="layout-thanks">
          <div class="page-thanks__inner inner">
            <div class="page-thanks__text-wrap">
              <p class="page-thanks__text-title">
                お問い合わせ内容を送信完了しました
              </p>
              <p class="page-thanks__text">
                このたびは、お問い合わせ頂き<br
                  class="is-sp"
                />誠にありがとうございます。<br />
                お送り頂きました内容を確認の上、<br
                class="is-sp"
              />3営業日以内に折り返しご連絡させて頂きます。<br />
                また、ご記入頂いたメールアドレスへ、<br
                class="is-sp"
              />自動返信の確認メールをお送りしております。
              </p>
            </div>
          </div>
        </div>
      </div>
    </main>
<?php get_footer(); ?>