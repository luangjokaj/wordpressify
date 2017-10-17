<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     2.6.0
 */

if (! defined( 'ABSPATH' )) {
	exit; // Exit if accessed directly
}
?>
<div class="dashboard">
	<div class="user-icon">
		<img src="<?php echo get_template_directory_uri(); ?>/img/user.svg" alt="Account 🤠">
	</div>
	<div class="intro">
		<p><?php
			/* translators: 1: user display name 2: logout url */
			printf(
				__( '👋 Hello, %1$s.', 'woocommerce' ),
				'<strong class="name">' . esc_html( $current_user->user_firstname ) . '</strong>'
			);
		?></p>

		<p><?php
			printf(
				__( 'From your account dashboard you can view your <a href="%1$s">recent orders</a>, manage your <a href="%2$s">shipping and billing addresses</a> and <a href="%3$s">edit your password and account details</a>.', 'woocommerce' ),
				esc_url( wc_get_endpoint_url( 'orders' ) ),
				esc_url( wc_get_endpoint_url( 'edit-address' ) ),
				esc_url( wc_get_endpoint_url( 'edit-account' ) )
			);
		?></p>
	</div>
</div>
<main>
	<div>
		<img src="<?php echo get_template_directory_uri(); ?>/img/returnshop.svg" alt="Shopping 🛒">
		<a class="button wc-backward" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
		<?php _e( 'Return to shop', 'woocommerce' ) ?>
		</a>
	</div>
	<div>
		<img src="<?php echo get_template_directory_uri(); ?>/img/gotoorders.svg" alt="Orders 📦">
		<a class="button wc-backward" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>orders">
		<?php _e( 'Go to Orders', 'woocommerce' ) ?>
		</a>
	</div>
</main>

<?php
	/**
	 * My Account dashboard.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_dashboard' );

	/**
	 * Deprecated woocommerce_before_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_before_my_account' );

	/**
	 * Deprecated woocommerce_after_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_after_my_account' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
