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
	<div class="flex h-screen w-full items-center justify-center bg-[#FAFAFA]">

		<div class="w-full rounded-lg border bg-white px-8 py-8" style="max-width: 550px;">
			<h1 class="mb-6 text-[32px] font-geova font-semibold leading-[40px] tracking-[-0.25px] text-red-600">Set Your Password</h1>

			<?php
			if (
				isset( $_POST['newpassword'], $_POST['confirmpassword'], $_POST['set_password_nonce'] )
				&& wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['set_password_nonce'] ) ), 'set_password_action' )
			) {
				$newpassword     = sanitize_text_field( wp_unslash( $_POST['newpassword'] ) );
				$confirmpassword = sanitize_text_field( wp_unslash( $_POST['confirmpassword'] ) );

				if ( $newpassword === $confirmpassword ) {
					reset_password( $user, $newpassword );
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

			<form method="post" class="flex max-w-[550px] flex-col gap-y-10">
				<?php wp_nonce_field( 'set_password_action', 'set_password_nonce' ); ?>

				<div class="space-y-8">
					<div>
						<label for="newpassword" class="block text-sm font-medium text-gray-700">Password</label>
						<input type="password" name="newpassword" id="newpassword" required class="mt-1 w-full rounded-md border px-3 py-2 shadow-sm focus:border-red-500 focus:ring-red-500 sm:text-sm">
					</div>

					<div>
						<label for="confirmpassword" class="block text-sm font-medium text-gray-700">Confirm Password</label>
						<input type="password" name="confirmpassword" id="confirmpassword" required class="mt-1 w-full rounded-md border px-3 py-2 shadow-sm focus:border-red-500 focus:ring-red-500 sm:text-sm">
					</div>
				</div>

				<button type="submit" class="w-full rounded-md bg-red-600 px-4 py-2 font-medium text-white">Confirm</button>
			</form>

		</div>

	</div>
</main><!-- #main -->

<?php
get_sidebar();
get_footer();
