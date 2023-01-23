module.exports = {
  darkMode: "class",
  content: ["./**/*.php", "./src/**/*.js", "./node_modules/flowbite/**/*.js"],
  theme: {
    extend: {
      dropShadow: {
        "ca-text": "0 1 1 rgba(0,0,0, 0.7)"
      },
      boxShadow: {
        deep: "0 3px 6px rgba(53, 84, 110, 0.5)",
        deepHover: "0 3px 6px rgba(53, 84, 110, 0.8)"
      },
      scale: {
        md: "1.07",
        lg: "1.15"
      },
      colors: {
        primary500: "#35546e",
        primarySoft: "#4D6D88",
        primaryHard: "2D4B65",
        second500: "#FFBF0F",
        secondSoft: "#ffd970",
        secondHard: "#FA910A",
        textColor: ""
      },
      fontFamily: {
        sans: ["Roboto", "sans-serif"],
        osw: ["Oswald", "sans-serif"],
        mainHead: ["Yanone Kaffeesatz", "sans-serif"],
        ibm: ["IBM Plex Mono", "monospace"],
        apple: ["-apple-system", "sans-serif"]
      },
      gridTemplateRows: {
        card: "grid-template-columns: 0.5fr 1.5fr"
      }
    }
  },
  plugins: [require("@tailwindcss/typography"), require("flowbite/plugin")]
};
