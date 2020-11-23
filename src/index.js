import { registerPlugin } from "@wordpress/plugins";
import { WooNavigationItem } from "@woocommerce/navigation";
import { addFilter } from "@wordpress/hooks";

const Container = () => <div>Hello World</div>;

addFilter("woocommerce_admin_pages_list", "examples", (pages) => {
  pages.push({
    container: Container,
    path: "/examples",
    wpOpenMenu: "toplevel_page_woocommerce",
    breadcrumbs: ["Example WC Admin Page"],
  });

  return pages;
});

const MyPlugin = () => {
  return (
    <WooNavigationItem parentMenu="examples-root" item="example-1">
      <a className="components-button" href="www.example.com/1">
        Example 1 😜
      </a>
    </WooNavigationItem>
  );
};

registerPlugin("my-plugin", { render: MyPlugin });
