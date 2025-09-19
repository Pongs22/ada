<?php
/**
 * The template for displaying all pages
 *
 * Template Name: Set Password
 *
 * @package firstfold
 */

get_header();

$key   = isset( $_GET['key'] ) ? sanitize_text_field( wp_unslash( $_GET['key'] ) ) : '';
$login = isset( $_GET['login'] ) ? sanitize_text_field( wp_unslash( $_GET['login'] ) ) : '';

if ( empty( $key ) || empty( $login ) ) {
	include get_404_template();
	exit;
}

$user = check_password_reset_key( $key, $login );
if ( is_wp_error( $user ) ) {
	include get_404_template();
	exit;
}
?>

<main id="primary" class="site-main rounded-lg border" data-barba="container" data-barba-namespace="<?php echo esc_attr( get_the_title() ); ?>">
	<div class="fixed z-[999] flex h-screen w-full items-center justify-center bg-[#FAFAFA]">

		<div class="form-container flex w-full flex-col rounded-lg border bg-white px-8 py-8" style="max-width: 550px;">
			<div class="form-logo mx-auto size-[80px]">
				<?php
				the_custom_logo();
				?>
			</div>
			<h1 class="mb-6 text-center font-geova text-[20px] font-semibold leading-[28px] tracking-[-0.25px] text-red-600 md:text-[24px] md:leading-[31px] lg:text-[32px] lg:leading-[40px]">Set Your Password</h1>

			<?php
			if (
				isset( $_POST['newpassword'], $_POST['confirmpassword'], $_POST['set_password_nonce'] )
				&& wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['set_password_nonce'] ) ), 'set_password_action' )
			) {
				$newpassword     = sanitize_text_field( wp_unslash( $_POST['newpassword'] ) );
				$confirmpassword = sanitize_text_field( wp_unslash( $_POST['confirmpassword'] ) );

				if ( $newpassword === $confirmpassword ) {
					reset_password( $user, $newpassword );

					wp_logout();

					echo "<script>
						localStorage.setItem('password_updated', '1');
						window.location.href = '" . esc_url( home_url() ) . "';
					</script>";
					exit;
				} else {
					echo '<p class="text-red-600">Passwords do not match. Please try again.</p>';
				}
			}
			?>

			<form method="post" class="set-password-form flex max-w-[550px] flex-col gap-y-10">
				<?php wp_nonce_field( 'set_password_action', 'set_password_nonce' ); ?>

				<div class="space-y-8">
					<div class="new-password-input relative">
						<label for="newpassword" class="block text-sm font-medium text-gray-700">Password</label>
						<input type="password" name="newpassword" id="newpassword" class="relative mt-1 w-full rounded-md border px-3 py-2 shadow-sm focus:border-red-500 focus:ring-red-500 sm:text-sm">
							<button type="button" class="eye-btn" data-eye="open">
								<img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/frontend/resources/img/ada-opened-eye.svg' ); ?>"
							/>
							</button>
							<button type="button" class="closed-eye-btn hidden" data-eye="closed">
								<img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/frontend/resources/img/ada-closed-eye.svg' ); ?>"
							/>
							</button>
						</input>
					</div>

					<div class="confirm-password-input relative">
						<label for="confirmpassword" class="block text-sm font-medium text-gray-700">Confirm Password</label>
						<input type="password" name="confirmpassword" id="confirmpassword" class="mt-1 w-full rounded-md border px-3 py-2 shadow-sm focus:border-red-500 focus:ring-red-500 sm:text-sm">
						<button type="button" class="eye-btn" data-eye="open">
							<img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/frontend/resources/img/ada-opened-eye.svg' ); ?>"
						/>
						</button>
						<button type="button" class="closed-eye-btn hidden" data-eye="closed">
							<img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/frontend/resources/img/ada-closed-eye.svg' ); ?>"
						/>
						</button>
					</div>
				</div>
				<div class="ff-button-primary">
					<button type="submit" class="confirm-btn w-full"> 
						<span class="btn-text">CONFIRM</span>
						<div class="loader"></div>
					</button>
				</div>
			</form>
		</div>
	</div>
</main><!-- #main -->

<?php
get_sidebar();
get_footer();
