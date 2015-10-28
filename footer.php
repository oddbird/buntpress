<footer role="contentinfo">
<?php
  echo sprintf(
    __( '%1$s %2$s %3$s. All Rights Reserved.', 'buntpress' ),
    'Copyright &copy;',
    date( 'Y' ),
    esc_html( get_bloginfo( 'name' ) )
  );
?>
</footer>

<?php wp_footer(); ?>
</body>
</html>
